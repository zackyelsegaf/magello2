<?php

use App\Http\Controllers\BukuBesar\AkunController;
use App\Http\Controllers\BukuBesar\AnggaranAkunController;
use App\Http\Controllers\BukuBesar\JurnalController;
use App\Http\Controllers\BukuBesar\PembayaranLainnyaController;
use App\Http\Controllers\BukuBesar\PenerimaanLainnyaController;
use App\Livewire\BukuBesar\AkunForm;
use App\Livewire\BukuBesar\AnggaranAkunForm;
use App\Livewire\BukuBesar\JurnalForm;
use App\Livewire\BukuBesar\PembayaranLainnyaForm;
use App\Livewire\BukuBesar\PenerimaanLainnyaForm;
use Illuminate\Support\Facades\Route;

//-------------------------------- AKUN ---------------------------------//
// Route::get('akun/add/new', AkunForm::class)->middleware('auth')->name('akun/add/new');
// Route::get('/akun/edit/{id}', AkunForm::class)->name('akun/edit');
// Route::controller(AkunController::class)->group(function () {
//     Route::get('akun/list/page', 'akunList')->middleware('auth')->name('akun/list/page');
//     Route::post('/akun/delete', 'delete')->name('akun/delete');
//     Route::get('get-akun-data', 'getAkun')->name('get-akun-data');
// });

//-------------------------------- JURNAL ---------------------------------//
Route::get('jurnal/add/new', JurnalForm::class)->middleware('auth')->name('jurnal/add/new');
Route::get('/jurnal/edit/{id}', JurnalForm::class)->name('jurnal/edit');
Route::controller(JurnalController::class)->group(function () {
    Route::get('jurnal/list/page', 'jurnalList')->middleware('auth')->name('jurnal/list/page');
    Route::post('/jurnal/delete', 'delete')->name('jurnal/delete');
    Route::get('get-jurnal-data', 'getJurnal')->name('get-jurnal-data');
});

//-------------------------------- ANGGARAN AKUN ---------------------------------//
Route::get('anggaranakun/add/new', AnggaranAkunForm::class)->middleware('auth')->name('anggaranakun/add/new');
Route::get('/anggaranakun/edit/{id}', AnggaranAkunForm::class)->name('anggaranakun/edit');
Route::controller(AnggaranAkunController::class)->group(function () {
    Route::get('anggaranakun/list/page', 'anggaranList')->middleware('auth')->name('anggaranakun/list/page');
    Route::post('/anggaranakun/delete', 'delete')->name('anggaranakun/delete');
    Route::get('get-anggaranakun-data', 'getAnggaran')->name('get-anggaranakun-data');
});

//-------------------------------- PEMBAYARAN LAINNYA ---------------------------------//
Route::get('pembayaranlainnya/add/new', PembayaranLainnyaForm::class)->middleware('auth')->name('pembayaranlainnya/add/new');
Route::get('/pembayaranlainnya/edit/{id}', PembayaranLainnyaForm::class)->name('pembayaranlainnya/edit');
Route::controller(PembayaranLainnyaController::class)->group(function () {
    Route::get('pembayaranlainnya/list/page', 'pembayaranList')->middleware('auth')->name('pembayaranlainnya/list/page');
    Route::post('/pembayaranlainnya/delete', 'delete')->name('pembayaranlainnya/delete');
    Route::get('get-pembayaranlainnya-data', 'getPembayaran')->name('get-pembayaranlainnya-data');
});

//-------------------------------- PENERIMAAN LAINNYA ---------------------------------//
Route::get('penerimaanlainnya/add/new', PenerimaanLainnyaForm::class)->middleware('auth')->name('penerimaanlainnya/add/new');
Route::get('/penerimaanlainnya/edit/{id}', PenerimaanLainnyaForm::class)->name('penerimaanlainnya/edit');
Route::controller(PenerimaanLainnyaController::class)->group(function () {
    Route::get('penerimaanlainnya/list/page', 'penerimaanList')->middleware('auth')->name('penerimaanlainnya/list/page');
    Route::post('/penerimaanlainnya/delete', 'delete')->name('penerimaanlainnya/delete');
    Route::get('get-penerimaanlainnya-data', 'getPenerimaan')->name('get-penerimaanlainnya-data');
});