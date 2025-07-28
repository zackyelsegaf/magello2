@extends('laporan.semua')
@section('menu_laporan')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <a href="{{ route('laporan/penjualan/faktur') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Daftar Faktur Penjualan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/pengiriman') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Daftar Pengiriman Pesanan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/retur') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penjualan Per Barang - Omset</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/penjualanbarangomset') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Daftar Retur Penjualan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/pelangganringkasan') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penjualan Per Pelanggan - Ringkasan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/pelangganrincian') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penjualan Per Pelanggan - Rincian</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/pelangganbarang') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penjualan Pelanggan Per Barang</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/barangringkasan') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penjualan Per Barang - Ringkasan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/barangrincian') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penjualan Per Barang - Rincian</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/barangomset') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penjualan Per Barang - Omset</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/barangkuantitas') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penjualan Per Barang - Kuantitas</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/penjualanpelanggan') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Retur Penjualan Per Pelanggan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/penjualanbarang') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Retur Penjualan Per Barang</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/returrincian') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Rincian Daftar Retur Penjualan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/pesananpelanggan') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Pesanan Penjualan Per Pelanggan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/pesananbarang') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Pesanan Penjualan Per Barang</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/penawaranpelanggan') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penawaran Penjualan Per Pelanggan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/penawaranbarang') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Penawaran Penjualan Per Barang</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/historipengiriman') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Histori Pengiriman Pesanan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('laporan/penjualan/historipesanan') }}" class="text-dark">
                <div class="card rounded-default shadow bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa fa-book p-3 rounded-circle bg-primary text-white"></i>
                            </div>
                            <p class="h5 ml-3">Histori Pesanan Penjualan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection