<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Nilai;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sastrawi\Stemmer\StemmerFactory;

class JawabanController extends Controller
{
    public function uts(Request $request, $id_matakuliah)
    {
        return $this->processExam($request, $id_matakuliah, 'uts', 'utschance');
    }

    public function uas(Request $request, $id_matakuliah)
    {
        return $this->processExam($request, $id_matakuliah, 'uas', 'uaschance');
    }

    private function processExam(Request $request, $id_matakuliah, $jenis_ujian, $chance_column)
    {
        $npm = Auth::user()->nim;
        $nama = Auth::user()->name;

        // Retrieve or initialize the record for the user and subject
        $nilai = Nilai::firstOrNew(
            ['npm' => $npm, 'id_matakuliah' => $id_matakuliah],
            ['nama_mahasiswa' => $nama, 'utschance' => 3, 'uaschance' => 3]
        );

        // Check if chances are available for the specific exam type
        if ($nilai->{$chance_column} <= 0) {
            return redirect()->route("mahasiswa-matakuliah-$jenis_ujian")->with('toast_error', 'Kesempatan submit sudah habis');
        }

        // Decrement chances by 1 for the specific exam type
        $nilai->{$chance_column}--;

        // Get answers from the request
        $jawaban = [
            $request->input('jawaban1'),
            $request->input('jawaban2'),
            $request->input('jawaban3'),
            $request->input('jawaban4'),
            $request->input('jawaban5'),
        ];

        // Preprocess answers
        $preprocessed_texts = array_map([$this, 'preprocessText'], $jawaban);

        // Get questions and answer keys from the database
        $soals = Soal::where('jenis_ujian', ucfirst($jenis_ujian))
            ->where('id_matakuliah', $id_matakuliah)
            ->get();

        $kunci_jawaban = array_map([$this, 'preprocessText'], $soals->pluck('kunci')->toArray());

        // Combine answers and answer keys for IDF calculation
        $all_texts = array_merge($preprocessed_texts, $kunci_jawaban);

        // Calculate TF-IDF for answers and answer keys
        $tfidf_scores = [];
        $idf = $this->computeIdf($all_texts);
        foreach ($preprocessed_texts as $index => $text) {
            $tf_jawaban = $this->computeTf($text);
            $tf_kunci = $this->computeTf($kunci_jawaban[$index]);

            $tfidf_jawaban = $this->computeTfidfScore($tf_jawaban, $idf);
            $tfidf_kunci = $this->computeTfidfScore($tf_kunci, $idf);

            $tfidf_scores[$index] = [
                'tfidf_jawaban' => $tfidf_jawaban,
                'tfidf_kunci' => $tfidf_kunci,
            ];
        }

        // Calculate cosine similarity between answers and answer keys
        $similarity_scores = array_map(function ($scores) {
            return $this->cosineSimilarity($scores['tfidf_jawaban'], $scores['tfidf_kunci']);
        }, $tfidf_scores);

        // Calculate total score based on similarity scores and weights from the database
        $total_score = 0;
        $max_score = 0;
        foreach ($soals as $index => $soal) {
            $bobot = $soal->bobot;
            $percentage = $similarity_scores[$index] * 100;

            if ($percentage >= 50) {
                $total_score += $bobot;
            } elseif ($percentage > 35) {
                $total_score += $bobot / 2;
            } else {
                $total_score += 0;
            }

            $max_score += $bobot; // Summing up the total maximum score
        }

        // Calculate final score as a percentage of the maximum score
        $final_score = $max_score > 0 ? ($total_score / $max_score) * 100 : 0;

        // Update or save the final score and chance
        $nilai->{$jenis_ujian} = floatval(number_format($final_score, 2, '.', '')); // Convert to float with 2 decimal places
        $nilai->save();

        // Save user answers and final score to historys table
        History::create([
            'id_matkul' => $id_matakuliah,
            'nama' => $nama,
            'nim' => $npm,
            'jenis_ujian' => ucfirst($jenis_ujian),
            'jawaban1' => $jawaban[0] ?? null,
            'jawaban2' => $jawaban[1] ?? null,
            'jawaban3' => $jawaban[2] ?? null,
            'jawaban4' => $jawaban[3] ?? null,
            'jawaban5' => $jawaban[4] ?? null,
            'nilai' => $final_score,
        ]);

        return redirect()->route("mahasiswa-matakuliah-$jenis_ujian")->with('toast_success', 'Ujian Telah Diselesaikan');
    }

    private function preprocessText($text)
    {
        // Step 1: Case folding
        $text = strtolower($text);

        // Step 2: Tokenization
        $words = explode(' ', $text);

        // Step 3: Stopword removal
        $stopWords = [
            'yang', 'untuk', 'dan', 'di', 'pada', 'dengan', 'adalah', 'atau',
            'ke', 'dari', 'ini', 'itu', 'oleh', 'sebagai', 'dalam', 'karena',
            'ada', 'mereka', 'juga', 'sangat', 'lagi', 'sudah', 'tersebut',
        ];
        $filteredWords = array_diff($words, $stopWords);

        // Step 4: Stemming
        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();
        $stemmedWords = array_map([$stemmer, 'stem'], $filteredWords);

        // Step 5: Reconstruct text
        return implode(' ', $stemmedWords);
    }

    private function computeTf($text)
    {
        $words = explode(' ', $text);
        $word_counts = array_count_values($words);
        $tf = [];

        $total_words = count($words);
        foreach ($word_counts as $word => $count) {
            $tf[$word] = $count / $total_words;
        }

        return $tf;
    }

    private function computeIdf($texts)
    {
        $num_docs = count($texts);
        $idf = [];

        foreach ($texts as $text) {
            $words = array_unique(explode(' ', $text));
            foreach ($words as $word) {
                if (!isset($idf[$word])) {
                    $document_frequency = count(array_filter($texts, function ($doc) use ($word) {
                        return strpos($doc, $word) !== false;
                    }));
                    $idf[$word] = log(($num_docs + 1) / ($document_frequency + 1)) + 1;
                }
            }
        }

        return $idf;
    }

    private function computeTfidfScore($tf, $idf)
    {
        $tfidf = [];
        foreach ($tf as $word => $tf_value) {
            if (isset($idf[$word])) {
                $tfidf[$word] = $tf_value * $idf[$word];
            }
        }
        return $tfidf;
    }

    private function cosineSimilarity($vectorA, $vectorB)
    {
        $dotProduct = 0.0;
        $magnitudeA = 0.0;
        $magnitudeB = 0.0;

        $all_keys = array_unique(array_merge(array_keys($vectorA), array_keys($vectorB)));

        foreach ($all_keys as $key) {
            $valueA = $vectorA[$key] ?? 0.0;
            $valueB = $vectorB[$key] ?? 0.0;

            $dotProduct += $valueA * $valueB;
            $magnitudeA += $valueA ** 2;
            $magnitudeB += $valueB ** 2;
        }

        $magnitude = sqrt($magnitudeA) * sqrt($magnitudeB);

        return $magnitude == 0.0 ? 0.0 : $dotProduct / $magnitude;
    }
}