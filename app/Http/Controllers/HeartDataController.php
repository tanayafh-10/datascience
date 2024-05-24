<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeartData; // Ganti dengan model yang sesuai


class HeartDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heartData = HeartData::paginate(50);
        return view('result', compact('heartData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
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

        HeartData::create($request->all());

        return redirect()->route('result.index')->with('success', 'Data added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = HeartData::findOrFail($id);
        return view('result', ['data' => $data, 'action' => 'edit']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
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

        $data = HeartData::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('result.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = HeartData::findOrFail($id);
        $data->delete();

        return redirect()->route('result.index')->with('success', 'Data deleted successfully.');
    }
}
