<?php

namespace App\Http\Controllers\Aktiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AktivaTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AktivaTetapList()
    {
        return view('aktiva.aktivatetap.aktivatetap');
    }

    /**
     * Show the form for creating a new resource.
     */
        public function AktivaTetapAddNew()
        {
            return view('aktiva.aktivatetap.aktivatetapadd');
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('aktiva.aktiva_tetap.index')->with('success', 'Aktiva Tetap created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('aktiva.aktiva_tetap.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('aktiva.aktiva_tetap.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('aktiva.aktiva_tetap.index')->with('success', 'Aktiva Tetap updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('aktiva.aktiva_tetap.index')->with('success', 'Aktiva Tetap deleted successfully.');
        // --- IGNORE ---
    }
}
