<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipeAktivaTetapController;
use App\Http\Controllers\TipeAktivaTetapPajakController;

Route::prefix('aktiva')->name('aktiva.')->group(function () {
    Route::resource('tipe', TipeAktivaTetapController::class);
    Route::resource('pajak', TipeAktivaTetapPajakController::class);
});
