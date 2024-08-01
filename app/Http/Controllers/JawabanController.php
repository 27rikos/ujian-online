<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Soal; // Make sure to include the Nilai model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sastrawi\Stemmer\StemmerFactory;

class JawabanController extends Controller
{
    public function uts(Request $request, $id_matakuliah)
    {
        return $this->processExam($request, $id_matakuliah, 'uts');
    }

    public function uas(Request $request, $id_matakuliah)
    {
        return $this->processExam($request, $id_matakuliah, 'uas');
    }

    private function processExam(Request $request, $id_matakuliah, $jenis_ujian)
    {
        // Mendapatkan jawaban dari request
        $jawaban = [
            $request->input('jawaban1'),
            $request->input('jawaban2'),
            $request->input('jawaban3'),
            $request->input('jawaban4'),
            $request->input('jawaban5'),
        ];

        // Melakukan preprocess pada jawaban
        $preprocessed_texts = [];
        foreach ($jawaban as $text) {
            $preprocessed_texts[] = $this->preprocessText($text);
        }

        // Mendapatkan kunci jawaban dari database
        $soals = Soal::where('jenis_ujian', ucfirst($jenis_ujian))
            ->where('id_matakuliah', $id_matakuliah)
            ->get();

        $kunci_jawaban = [];
        foreach ($soals as $soal) {
            $kunci_jawaban[] = $this->preprocessText($soal->kunci);
        }

        // Menggabungkan jawaban dan kunci jawaban untuk perhitungan IDF
        $all_texts = array_merge($preprocessed_texts, $kunci_jawaban);

        // Menghitung TF-IDF untuk jawaban dan kunci jawaban
        $tfidf_scores = [];
        $idf = $this->computeIdf($all_texts);
        for ($i = 0; $i < count($preprocessed_texts); $i++) {
            $tf_jawaban = $this->computeTf($preprocessed_texts[$i]);
            $tf_kunci = $this->computeTf($kunci_jawaban[$i]);

            $tfidf_jawaban = $this->computeTfidfScore($preprocessed_texts[$i], $tf_jawaban, $idf);
            $tfidf_kunci = $this->computeTfidfScore($kunci_jawaban[$i], $tf_kunci, $idf);

            $tfidf_scores[$i] = [
                'tf_jawaban' => $tf_jawaban,
                'idf' => $idf,
                'tfidf_jawaban' => $tfidf_jawaban,
                'tfidf_kunci' => $tfidf_kunci,
            ];
        }

        // Menghitung cosine similarity antara jawaban dan kunci jawaban
        $similarity_scores = [];
        foreach ($tfidf_scores as $index => $scores) {
            $similarity_scores[$index] = $this->cosineSimilarity($scores['tfidf_jawaban'], $scores['tfidf_kunci']);
        }

        // Mengonversi similarity scores menjadi persentase
        $percentage_scores = [];
        foreach ($similarity_scores as $index => $similarity) {
            $percentage_scores[$index] = $similarity * 100;
        }

        // Store data nilai akhir
        $nama = Auth::user()->name;
        $npm = Auth::user()->nim;
        $average_score = array_sum($percentage_scores) / count($percentage_scores); // Calculate average score in percentage

        // Save the final score to the database
        $nilai = Nilai::where('npm', $npm)->where('id_matakuliah', $id_matakuliah)->first();
        $average_score = floatval(number_format($average_score, 2, '.', '')); // Convert to float with 2 decimal places

        if ($nilai) {
            $nilai->{$jenis_ujian} = $average_score;
        } else {
            $nilai = new Nilai;
            $nilai->npm = $npm;
            $nilai->nama_mahasiswa = $nama;
            $nilai->id_matakuliah = $id_matakuliah;
            $nilai->{$jenis_ujian} = $average_score;
        }
        $nilai->save();

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
        $stemmedWords = [];
        foreach ($filteredWords as $word) {
            $stemmedWords[] = $stemmer->stem($word);
        }

        // Step 5: Reconstruct text
        $processedText = implode(' ', $stemmedWords);

        return $processedText;
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
            $words = explode(' ', $text);
            foreach ($words as $word) {
                if (!isset($idf[$word])) {
                    $document_frequency = 0;
                    foreach ($texts as $doc) {
                        if (strpos($doc, $word) !== false) {
                            $document_frequency++;
                        }
                    }
                    $idf[$word] = log(($num_docs + 1) / ($document_frequency + 1)) + 1;
                }
            }
        }

        return $idf;
    }

    private function computeTfidfScore($text, $tf, $idf)
    {
        $tfidf = [];
        $words = explode(' ', $text);

        foreach ($words as $word) {
            if (isset($tf[$word]) && isset($idf[$word])) {
                $tfidf[$word] = $tf[$word] * $idf[$word];
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
            $magnitudeA += $valueA * $valueA;
            $magnitudeB += $valueB * $valueB;
        }

        if ($magnitudeA == 0 || $magnitudeB == 0) {
            return 0.0;
        }

        return $dotProduct / (sqrt($magnitudeA) * sqrt($magnitudeB));
    }
}
