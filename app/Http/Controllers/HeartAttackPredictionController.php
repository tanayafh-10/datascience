<?php

namespace App\Http\Controllers;

use App\Http\Requests\CSVUploadRequest;
use Illuminate\Http\Request;
use App\Models\HeartData; // Ganti dengan model yang sesuai
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Phpml\Dataset\ArrayDataset;
use Phpml\Classification\NaiveBayes;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Metric\Accuracy;
use Phpml\Metric\ConfusionMatrix;

class HeartAttackPredictionController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadFile(CSVUploadRequest $request)
    {
        $file = $request->file('file');

        if (($handle = fopen($file, 'r')) !== FALSE) {
            // Baca seluruh isi file ke dalam array
            $data = [];
            while (($row = fgetcsv($handle, null, ',')) !== FALSE) {
                $data[] = $row;
            }
            fclose($handle);

            // Ambil header CSV
            $header = array_shift($data);

            // Trim spasi dari setiap elemen header
            $header = array_map('trim', $header);

            // Debug: Log header CSV dan header yang diharapkan
            Log::debug('Header CSV: ' . json_encode($header));
            Log::debug('Expected Headers: ' . json_encode(['age', 'gender', 'impulse', 'pressurehight', 'pressurelow', 'glucose', 'kcm', 'troponin', 'class']));

            // Debug: Print headers for manual inspection
            echo '<pre>';
            var_dump($header);
            var_dump(['age', 'gender', 'impulse', 'pressurehight', 'pressurelow', 'glucose', 'kcm', 'troponin', 'class']);
            echo '</pre>';

            // Validasi header sesuai dengan kolom tabel
            $expectedHeaders = ['age', 'gender', 'impulse', 'pressurehight', 'pressurelow', 'glucose', 'kcm', 'troponin', 'class']; // Sesuaikan dengan kolom tabel Anda
            if ($header !== $expectedHeaders) {
                return redirect()->back()->withErrors(['File CSV tidak sesuai dengan format yang diharapkan']);
            }

            // Iterasi melalui baris CSV yang tersisa dan simpan ke database
            foreach ($data as $row) {
                // Buat validasi untuk setiap baris jika diperlukan
                $record = [
                    'age' => $row[0],
                    'gender' => $row[1],
                    'impulse' => $row[2],
                    'pressurehight' => $row[3],
                    'pressurelow' => $row[4],
                    'glucose' => $row[5],
                    'kcm' => $row[6],
                    'troponin' => $row[7],
                    'class' => $row[8],
                ];

                $validator = Validator::make($record, [
                    'age' => 'required|integer',
                    'gender' => 'required|string',
                    'impulse' => 'required|integer',
                    'pressurehight' => 'required|integer',
                    'pressurelow' => 'required|integer',
                    'glucose' => 'required|integer',
                    'kcm' => 'required|float',
                    'troponin' => 'required|float',
                    'class' => 'required|string',
                ]);

                // if ($validator->fails()) {
                //     continue;
                // }

                HeartData::create($record);
            }
        }

        return redirect()->route('result')->with('success', 'File CSV berhasil diunggah dan data disimpan.');
    }

    public function result()
    {
        // Ambil data original untuk ditampilkan
        $heartData = HeartData::latest()->paginate(50);

        // Convert the paginated data into a dataset object
        $dataset = new ArrayDataset($heartData->items(), $heartData->pluck('class')->toArray());

        // Bagi data menjadi data training dan data testing
        $split = new StratifiedRandomSplit($dataset, 0.7);

        $trainingData = $split->getTrainSamples();
        $testingData = $split->getTestSamples();

        // Lakukan training menggunakan data training
        $classifier = new NaiveBayes();
        $samples = [];
        $labels = [];
        foreach ($trainingData as $item) {
            $samples[] = [
                $item['age'],
                $item['gender'],
                $item['impulse'],
                $item['pressurehight'],
                $item['pressurelow'],
                $item['glucose'],
                $item['kcm'],
                $item['troponin'],
            ];
            $labels[] = $item['class'];
        }
        $classifier->train($samples, $labels);

        // Lakukan prediksi untuk data testing
        $predictions = [];
        foreach ($testingData as $item) {
            $predictions[] = $classifier->predict([
                $item['age'],
                $item['gender'],
                $item['impulse'],
                $item['pressurehight'],
                $item['pressurelow'],
                $item['glucose'],
                $item['kcm'],
                $item['troponin'],
            ]);
        }

        // Hitung metrik evaluasi
        $testLabels = $split->getTestLabels();
        $accuracy = Accuracy::score($testLabels, $predictions);
        $confusionMatrix = ConfusionMatrix::compute($testLabels, $predictions);

        // Hitung presisi dan recall
        $truePositives = $confusionMatrix[1][1]; // True Positives
        $falsePositives = $confusionMatrix[0][1]; // False Positives
        $falseNegatives = $confusionMatrix[1][0]; // False Negatives

        $precision = $truePositives / ($truePositives + $falsePositives);
        $recall = $truePositives / ($truePositives + $falseNegatives);

        // Simpan model ke dalam database
        DB::table('models')->insert(['model' => serialize($classifier)]);

        // Kirim data ke halaman result
        return view('result', compact('heartData', 'trainingData', 'testingData', 'predictions', 'accuracy', 'confusionMatrix', 'precision', 'recall'));
    }


    public function destroy($id)
    {
        $data = HeartData::findOrFail($id);
        $data->delete();

        return redirect()->route('result')->with('success', 'Data deleted successfully.');
    }

}
