<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JawabanController extends Controller
{
    public function uts(Request $request, $id_matakuliah)
    {
        $data = $request->only(['jawaban1', 'jawaban2', 'jawaban3', 'jawaban4', 'jawaban5']);

        // Preprocess the user's answers
        $preprocessed_texts = $this->preprocessTexts($data);

        // Get all key answers from the database
        $soals = Soal::where('jenis_ujian', 'UTS')->where('id_matakuliah', $id_matakuliah)->get();

        // Preprocess the key answers
        $preprocessed_key_answers = [];
        foreach ($soals as $soal) {
            $preprocessed_key_answers[$soal->id] = $this->preprocessText($soal->kunci);
        }

        // Calculate TF-IDF vectors for user answers and key answers
        $tfidf_scores = $this->calculateTfidf($preprocessed_texts, $preprocessed_key_answers);

        // Calculate cosine similarity between user answers and key answers
        $similarity_scores = $this->calculateCosineSimilarity($tfidf_scores, $soals);

        // Convert similarity scores to percentage
        $percentage_scores = $this->convertToPercentage($similarity_scores);

        // Format the output and calculate the average score
        list($formatted_output, $average_score) = $this->formatOutput($percentage_scores);

        // Store data nilai akhir:
        $nama = Auth::user()->name;
        $npm = Auth::user()->nim;

        // Save the final score to the database
        $nilai = Nilai::where('npm', $npm)->where('id_matakuliah', $id_matakuliah)->first();
        if ($nilai) {
            $nilai->uts = $average_score;
        } else {
            $nilai = new Nilai;
            $nilai->npm = $npm;
            $nilai->nama_mahasiswa = $nama;
            $nilai->id_matakuliah = $id_matakuliah;
            $nilai->uts = $average_score;
        }
        $nilai->save();

        return redirect()->route('mahasiswa-matakuliah-uts')->with('toast_success', 'Ujian Telah Diselesaikan');
    }

    public function uas(Request $request, $id_matakuliah)
    {
        $data = $request->only(['jawaban1', 'jawaban2', 'jawaban3', 'jawaban4', 'jawaban5']);

        // Preprocess the user's answers
        $preprocessed_texts = $this->preprocessTexts($data);

        // Get all key answers from the database
        $soals = Soal::where('jenis_ujian', 'UAS')->where('id_matakuliah', $id_matakuliah)->get();

        // Preprocess the key answers
        $preprocessed_key_answers = [];
        foreach ($soals as $soal) {
            $preprocessed_key_answers[$soal->id] = $this->preprocessText($soal->kunci);
        }

        // Calculate TF-IDF vectors for user answers and key answers
        $tfidf_scores = $this->calculateTfidf($preprocessed_texts, $preprocessed_key_answers);

        // Calculate cosine similarity between user answers and key answers
        $similarity_scores = $this->calculateCosineSimilarity($tfidf_scores, $soals);

        // Convert similarity scores to percentage
        $percentage_scores = $this->convertToPercentage($similarity_scores);

        // Format the output and calculate the average score
        list($formatted_output, $average_score) = $this->formatOutput($percentage_scores);

        // Store data nilai akhir:
        $nama = Auth::user()->name;
        $npm = Auth::user()->nim;

        // Save the final score to the database
        $nilai = Nilai::where('npm', $npm)->where('id_matakuliah', $id_matakuliah)->first();
        if ($nilai) {
            $nilai->uas = $average_score;
        } else {
            $nilai = new Nilai;
            $nilai->npm = $npm;
            $nilai->nama_mahasiswa = $nama;
            $nilai->id_matakuliah = $id_matakuliah;
            $nilai->uas = $average_score;
        }
        $nilai->save();

        return redirect()->route('mahasiswa-matakuliah-uas')->with('toast_success', 'Ujian Telah Diselesaikan');
    }

    private function preprocessText($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^A-Za-z0-9\s]/', '', $text);
        $words = explode(' ', $text);
        $stopWords = [
            'yang', 'untuk', 'dan', 'di', 'pada', 'dengan', 'adalah', 'atau',
            'ke', 'dari', 'ini', 'itu', 'oleh', 'sebagai', 'dalam', 'karena',
            'ada', 'mereka', 'juga', 'sangat', 'lagi', 'sudah', 'tersebut',
        ];
        $filteredWords = array_diff($words, $stopWords);
        $stemmedWords = array_map(function ($word) {
            return rtrim($word, 'kan');
        }, $filteredWords);
        return implode(' ', $stemmedWords);
    }

    private function preprocessTexts($texts)
    {
        $preprocessed_texts = [];
        foreach ($texts as $key => $value) {
            if (is_string($value)) {
                $preprocessed_texts[$key] = $this->preprocessText($value);
            }
        }
        return $preprocessed_texts;
    }

    private function calculateTfidf($preprocessed_texts, $preprocessed_key_answers)
    {
        $all_texts = array_merge($preprocessed_texts, $preprocessed_key_answers);
        $num_docs = count($all_texts);

        $tfidf_scores = [];

        foreach ($preprocessed_key_answers as $key => $preprocessed_key_answer) {
            $tfidf_scores[$key] = $this->computeTfidf($preprocessed_key_answer, $all_texts, $num_docs);
        }

        foreach ($preprocessed_texts as $key => $preprocessed_text) {
            $tfidf_scores[$key] = $this->computeTfidf($preprocessed_text, $all_texts, $num_docs);
        }

        return $tfidf_scores;
    }

    private function computeTfidf($text, $all_texts, $num_docs)
    {
        $words = explode(' ', $text);
        $word_counts = array_count_values($words);
        $total_terms = count($words);

        // Compute TF
        $tf = [];
        foreach ($word_counts as $word => $count) {
            $tf[$word] = $count / $total_terms;
        }

        // Compute IDF
        $idf = [];
        foreach ($word_counts as $word => $count) {
            $document_frequency = 0;
            foreach ($all_texts as $text) {
                if (strpos($text, $word) !== false) {
                    $document_frequency++;
                }
            }
            $idf[$word] = log($num_docs / ($document_frequency ?: 1)); // Avoid division by zero
        }

        // Compute TF-IDF
        $tfidf = [];
        foreach ($tf as $word => $tf_value) {
            $tfidf[$word] = $tf_value * ($idf[$word] ?? 0);
        }

        return $tfidf;
    }

    private function calculateCosineSimilarity($tfidf_scores, $soals)
    {
        $similarity_scores = [];

        foreach ($soals as $soal) {
            $key_answer_vector = $tfidf_scores[$soal->id];
            foreach ($tfidf_scores as $key => $user_answer_vector) {
                if (strpos($key, 'jawaban') === 0) {
                    $similarity_scores[$key][$soal->id] = $this->cosineSimilarity($key_answer_vector, $user_answer_vector);
                }
            }
        }

        return $similarity_scores;
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

    private function convertToPercentage($similarity_scores)
    {
        $percentage_scores = [];
        foreach ($similarity_scores as $user_answer => $key_scores) {
            foreach ($key_scores as $key_id => $similarity) {
                $percentage_scores[$user_answer] = $percentage_scores[$user_answer] ?? 0;
                $percentage_scores[$user_answer] = max($percentage_scores[$user_answer], $similarity * 100); // Get the highest similarity score
            }
        }
        return $percentage_scores;
    }

    private function formatOutput($percentage_scores)
    {
        $formatted_output = [];
        $total_percentage = 0;
        $count = count($percentage_scores);

        foreach ($percentage_scores as $user_answer => $percentage) {
            $formatted_output[] = "$user_answer=" . number_format($percentage, 2) . "%";
            $total_percentage += $percentage;
        }

        $average_score = $total_percentage / $count;
        return [implode(', ', $formatted_output), $average_score];
    }
}
