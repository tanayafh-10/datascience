<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeartData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HeartAttackPredictionController extends Controller
{
    // Menampilkan form upload
    public function showUploadForm()
    {
        return view('upload');
    }

    // Proses upload file CSV
    public function uploadFile(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil file yang diupload
        $file = $request->file('file');

        // Baca file CSV
        $data = array_map('str_getcsv', file($file));

        // Ambil header dari file CSV
        $header = array_shift($data);

        // Log header untuk debugging
        Log::info('CSV Header:', $header);

        // Proses setiap baris data
        foreach ($data as $index => $row) {
            if (count($row) !== count($header)) {
                Log::error("Row $index does not match header count", ['row' => $row]);
                continue;
            }

            $rowData = array_combine($header, $row);

            // Log rowData untuk debugging
            Log::info("Row Data $index:", $rowData);

            if (!$rowData) {
                Log::error("Failed to combine header with row $index", ['header' => $header, 'row' => $row]);
                continue;
            }

            // Pastikan semua kunci ada sebelum memasukkan ke database
            if (isset($rowData['age'], $rowData['gender'], $rowData['impulse'], $rowData['pressurehight'], $rowData['pressurelow'], $rowData['glucose'], $rowData['kcm'], $rowData['troponin'], $rowData['class'])) {
                // Insert data ke database
                HeartData::create([
                    'age' => $rowData['age'],
                    'gender' => $rowData['gender'],
                    'impulse' => $rowData['impulse'],
                    'pressurehight' => $rowData['pressurehight'],
                    'pressurelow' => $rowData['pressurelow'],
                    'glucose' => $rowData['glucose'],
                    'kcm' => $rowData['kcm'],
                    'troponin' => $rowData['troponin'],
                    'class' => $rowData['class'],
                ]);
            } else {
                Log::error("Missing required data in row $index", ['rowData' => $rowData]);
            }
        }

        return redirect()->route('upload.form')->with('success', 'File uploaded and data imported successfully!');
    }
}
