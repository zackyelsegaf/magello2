@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">
                                {{-- <i class="fas fa-book mr-3"></i> --}}
                                Buku Kas</h4>
                            <div class="btn-group float-right" role="group">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary veiwbutton dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Catat Transaksi</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="'.url('booking/detail/'.$record->id).'">
                                            <div class="dropdown-icon">
                                                <i class="fas fa-minus-circle"></i>
                                            </div>
                                            <span class="dropdown-content"> Catat Pengeluaran</span>
                                        </a>
                                        <a class="dropdown-item" href="'.url('booking/konsumen/detail/'.$record->id).'">
                                            <div class="dropdown-icon">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>
                                            <span class="dropdown-content"> Catat Pemasukan</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-top">
                    <div class="col px-3 py-2">
                        <h6 class="font-weight-bold">Kategori:</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
