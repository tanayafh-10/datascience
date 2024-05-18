<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\HeartData;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Validator;

// class HeartAttackPredictionController extends Controller
// {
//     // Menampilkan form upload
//     public function showUploadForm()
//     {
//         return view('upload');
//     }

//     // Proses upload file CSV
//     public function uploadFile(Request $request)
//     {
//         // Validasi file
//         $validator = Validator::make($request->all(), [
//             'file' => 'required|mimes:csv,txt|max:2048',
//         ]);

//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//         // Ambil file yang diupload
//         $file = $request->file('file');

//         // Baca file CSV
//         $data = array_map('str_getcsv', file($file));

//         // Ambil header dari file CSV
// $header = array_shift($data);

//         // Log header untuk debugging
//         Log::info('CSV Header:', $header);

//         // Proses setiap baris data
//         foreach ($data as $index => $row) {
//             if (count($row) !== count($header)) {
//                 Log::error("Row $index does not match header count", ['row' => $row]);
//                 continue;
//             }

//             $rowData = array_combine($header, $row);

//             // Log rowData untuk debugging
//             Log::info("Row Data $index:", $rowData);

//             if (!$rowData) {
//                 Log::error("Failed to combine header with row $index", ['header' => $header, 'row' => $row]);
//                 continue;
//             }

//             // Pastikan semua kunci ada sebelum memasukkan ke database
//             if (isset($rowData['age'], $rowData['gender'], $rowData['impulse'], $rowData['pressurehight'], $rowData['pressurelow'], $rowData['glucose'], $rowData['kcm'], $rowData['troponin'], $rowData['class'])) {
//                 // Insert data ke database
//                 HeartData::create([
//                     'age' => $rowData['age'],
//                     'gender' => $rowData['gender'],
//                     'impulse' => $rowData['impulse'],
//                     'pressurehight' => $rowData['pressurehight'],
//                     'pressurelow' => $rowData['pressurelow'],
//                     'glucose' => $rowData['glucose'],
//                     'kcm' => $rowData['kcm'],
//                     'troponin' => $rowData['troponin'],
//                     'class' => $rowData['class'],
//                 ]);
//             } else {
//                 Log::error("Missing required data in row $index", ['rowData' => $rowData]);
//             }
//         }

//         return redirect()->route('upload.form')->with('success', 'File uploaded and data imported successfully!');
//     }
// }

namespace App\Http\Controllers;

use App\Http\Requests\CSVUploadRequest;
use Illuminate\Http\Request;
use App\Models\HeartData; // Ganti dengan model yang sesuai
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;


class HeartAttackPredictionController extends Controller
{
    // Metode untuk menampilkan data yang sudah diunggah
    public function result()
    {
        $heartData = HeartData::latest()->paginate(50); // Menggunakan metode paginate() langsung di model HeartData
        return view('result', compact('heartData'));
    }


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
                    'kcm' => 'required|integer',
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
}
