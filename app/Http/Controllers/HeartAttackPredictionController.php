<?php
namespace App\Http\Controllers;

use App\Http\Requests\CSVUploadRequest;
use Illuminate\Http\Request;
use App\Models\HeartData; // Ganti dengan model yang sesuai
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Phpml\Classification\NaiveBayes;



class HeartAttackPredictionController extends Controller
{

    public function showUploadForm()
    {
        return view('result');
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
                    'kcm' => 'required|numeric',
                    'troponin' => 'required|numeric',
                    'class' => 'required|string',
                ]);

                // if ($validator->fails()) {
                //     continue;
                // }

                HeartData::create($record);
            }
        }

        return redirect()->back()->with('success', 'File CSV berhasil diunggah dan data disimpan.');
    } 

    private $classifier;
    private $trained;

    public function __construct()
    {
        // Load model yang telah dilatih saat constructor dipanggil
        $this->classifier = $this->loadModel();
        $this->trained = session()->has('classifier');
    }

    private function loadModel()
    {
        // Cek apakah model ada di session
        if (session()->has('classifier')) {
            return unserialize(session('classifier'));
        }

        // Jika tidak, buat classifier baru
        return new NaiveBayes();
    }

    public function trainModel()
    {
        $heartData = HeartData::all();
        $samples = [];
        $labels = [];

        foreach ($heartData as $data) {
            $samples[] = [
                $data->age,
                $data->gender,
                $data->impulse,
                $data->pressurehight,
                $data->pressurelow,
                $data->glucose,
                $data->kcm,
                $data->troponin,
            ];
            $labels[] = $data->class;
        }

        // Melatih model
        $this->classifier->train($samples, $labels);

        // Simpan model yang telah dilatih ke session
        session(['classifier' => serialize($this->classifier)]);
        $this->trained = true;
    }

    public function predictFromForm(Request $request)
    {
        try {
            if (!$this->trained) {
                return response()->json(['error' => 'Model belum dilatih. Lakukan pelatihan model terlebih dahulu.'], 400);
            }

            $newData = [
                $request->age,
                $request->gender,
                $request->impulse,
                $request->pressurehight,
                $request->pressurelow,
                $request->glucose,
                $request->kcm,
                $request->troponin,
            ];

            $predictedClass = $this->classifier->predict([$newData]);

            return response()->json(['predictedClass' => $predictedClass]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
