<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeartData;
use Illuminate\Support\Facades\DB;

class HeartCheckController extends Controller
{
    public function index()
    {
        return view('check');
    }

    public function result()
    {
        // Ambil data original untuk ditampilkan
        $heartData = HeartData::latest()->paginate(50);

        return view('result', compact('heartData'));
    }

    public function predict(Request $request)
    {
        // Validasi data yang diterima dari frontend
        $request->validate([
            'age' => 'required|numeric',
            'gender' => 'required|in:0,1',
            'impulse' => 'required|numeric',
            'pressurehight' => 'required|numeric',
            'pressurelow' => 'required|numeric',
            'glucose' => 'required|numeric',
            'kcm' => 'required|numeric',
            'troponin' => 'required|numeric',
        ]);

        // Lakukan prediksi menggunakan model yang telah disimpan sebelumnya
        $classifier = DB::table('models')->orderBy('id', 'desc')->first();
        $classifier = unserialize($classifier->model);
        $prediction = $classifier->predict([
            $request->age,
            $request->gender,
            $request->impulse,
            $request->pressurehight,
            $request->pressurelow,
            $request->glucose,
            $request->kcm,
            $request->troponin,
        ]);

        // Simpan data ke dalam tabel "heart"
        HeartData::create([
            'age' => $request->age,
            'gender' => $request->gender,
            'impulse' => $request->impulse,
            'pressurehight' => $request->pressurehight,
            'pressurelow' => $request->pressurelow,
            'glucose' => $request->glucose,
            'kcm' => $request->kcm,
            'troponin' => $request->troponin,
            'class' => $prediction,
        ]);

        // Kirim hasil prediksi ke frontend
        return response()->json(['result' => $prediction]);
    }
}
