<?php

use App\Http\Controllers\BukuBesar\AkunController;
use App\Http\Controllers\BukuBesar\JurnalController;
use App\Livewire\BukuBesar\AkunForm;
use App\Livewire\BukuBesar\JurnalForm;
use Illuminate\Support\Facades\Route;

//-------------------------------- AKUN ---------------------------------//
Route::get('akun/add/new', AkunForm::class)->middleware('auth')->name('akun/add/new');
Route::get('/akun/edit/{id}', AkunForm::class)->name('akun/edit');
Route::controller(AkunController::class)->group(function () {
    Route::get('akun/list/page', 'akunList')->middleware('auth')->name('akun/list/page');
    Route::post('/akun/delete', 'delete')->name('akun/delete');
    Route::get('get-akun-data', 'getAkun')->name('get-akun-data');
});

//-------------------------------- JURNAL ---------------------------------//
Route::get('jurnal/add/new', JurnalForm::class)->middleware('auth')->name('jurnal/add/new');
Route::get('/jurnal/edit/{id}', JurnalForm::class)->name('jurnal/edit');
Route::controller(JurnalController::class)->group(function () {
    Route::get('jurnal/list/page', 'jurnalList')->middleware('auth')->name('jurnal/list/page');
    Route::post('/jurnal/delete', 'delete')->name('jurnal/delete');
    Route::get('get-jurnal-data', 'getJurnal')->name('get-jurnal-data');
});