@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">{{ isset($title) ? $title : 'Semua Laporan' }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card rounded-default p-3 bg-dark text-white sidebar-menu">
                    <ul>
                        <li @class(['active' => request()->is('laporan/penjualan*')])><a href="{{ route('laporan/penjualan') }}">
                            <i class="fa fa-book mr-2"></i> Laporan Pejualan</a>
                        </li>
                        <li @class(['active' => request()->is('laporan/pembelian*')])><a href="{{ route('laporan/pembelian') }}">
                            <i class="fa fa-book mr-2"></i> Laporan Pembelian</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                @yield('menu_laporan')
            </div>
        </div>
    </div>
</div>
@endsection