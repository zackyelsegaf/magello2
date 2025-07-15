<?php

namespace App\Http\Controllers\Aktiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipeAktivaTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function TipeAktivaTetapList()
    {
        return view('aktiva.tipeaktivatetap.tipeaktivatetap');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function TipeAktivaTetapAddNew()
    {
        return view('aktiva.tipeaktivatetap.tipeaktivatetapadd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('aktiva.tipe_aktiva_tetap.index')->with('success', 'Tipe Aktiva Tetap created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('aktiva.tipe_aktiva_tetap.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('aktiva.tipe_aktiva_tetap.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('aktiva.tipe_aktiva_tetap.index')->with('success', 'Tipe Aktiva Tetap updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('aktiva.tipe_aktiva_tetap.index')->with('success', 'Tipe Aktiva Tetap deleted successfully.');
    }
}
