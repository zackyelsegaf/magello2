<?php

namespace App\Http\Controllers\Aktiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipeAktivaTetapPajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function TipeAktivaTetapPajakList()
    {
        return view('aktiva.tipeaktivatetappajak.tipeaktivatetappajak');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function TipeAktivaTetapPajakAddNew()
    {
        return view('aktiva.tipeaktivatetappajak.tipeaktivatetappajakadd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('aktiva.tipe_aktiva_tetap_pajak.index')->with('success', 'Tipe Aktiva Tetap Pajak created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('aktiva.tipe_aktiva_tetap_pajak.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('aktiva.tipe_aktiva_tetap_pajak.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('aktiva.tipe_aktiva_tetap_pajak.index')->with('success', 'Tipe Aktiva Tetap Pajak updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('aktiva.tipe_aktiva_tetap_pajak.index')->with('success', 'Tipe Aktiva Tetap Pajak deleted successfully.');
    }
}
