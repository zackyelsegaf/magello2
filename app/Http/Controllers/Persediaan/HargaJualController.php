<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HargaJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function HargaJualList()
    {
        return view('persediaan.hargajual.hargajual');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function HargaJualAddNew()
    {
        return view('persediaan.hargajual.hargajualadd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return redirect()->route('aktiva.tipe_aktiva_tetap.index')->with('success', 'Tipe Aktiva Tetap created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return view('aktiva.tipe_aktiva_tetap.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // return view('aktiva.tipe_aktiva_tetap.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return redirect()->route('aktiva.tipe_aktiva_tetap.index')->with('success', 'Tipe Aktiva Tetap updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return redirect()->route('aktiva.tipe_aktiva_tetap.index')->with('success', 'Tipe Aktiva Tetap deleted successfully.');
    }
}
