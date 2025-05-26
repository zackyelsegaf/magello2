@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Data Barang</h4>
                            <div x-data="{ open: false }">
                                <button @click="open = ! open">Toggle Content</button>

                                <div x-show="open">
                                    Content...
                                </div>
                            </div>
                            <x-select2.search name="pelanggan" label="Nama Pelanggan" :options="[
                                '001' => 'Ahmad Faiz',
                                '002' => 'Rina Lestari',
                                '003' => 'Bagus Pratama',
                                '004' => 'Siti Aminah',
                            ]" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="filterBox" class="col-md-4" style="{{ request('filter') == '1' ? '' : 'display: none;' }}">
                    <div class="card rounded-default p-3 bg-dark text-white">
                        <form method="GET" action="{{ route('barang/list/page') }}">

                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-center mb-0"
                                    id="BarangList">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="20"><input type="checkbox" id="select_all"></th>
                                            <th>No</th>
                                            <th hidden>ID</th>
                                            <th>No. Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi 1</th>
                                            <th>Deskripsi 2</th>
                                            {{-- <th>Jumlah</th> --}}
                                            <th>Satuan</th>
                                            <th>Harga Satuan</th>
                                            <th>Tipe</th>
                                            <th>Kategori</th>
                                            <th>Tipe Persediaan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                        <div class="mb-15 row">
                            <div class="col">
                                <a href="{{ route('barang/add/new') }}" class="btn btn-primary float-left veiwbutton"><i
                                        class="fas fa-plus mr-2"></i>Tambah</a>
                                <button class="btn btn-primary float-left veiwbutton ml-3" onclick="toggleFilter()"><i
                                        class="fas fa-filter mr-2"></i>Filter</button>
                                <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i
                                        class="fas fa-trash mr-2"></i>Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
