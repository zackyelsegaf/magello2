<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
            <li class="{{ set_active(['home']) }}"><a href="{{ route('home') }}"><i class="fas fa-tachometer-alt mr-2"></i><span>Dashboard</span></a> </li>
                <li class="list-divider"></li>
                {{-- <li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['form/allbooking']) }}" href="{{ route('form/allbooking') }}"> All Booking </a></li>
                        <li><a class="{{ request()->is('form/booking/edit/*') ? 'active' : '' }}"> Edit Booking </a></li>
                        <li><a class="{{ set_active(['form/booking/add']) }}" href="{{ route('form/booking/add') }}"> Add Booking </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Customers </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['form/allcustomers/page']) }}" href="{{ route('form/allcustomers/page') }}"> All customers </a></li>
                        <li><a class="{{ request()->is('form/customer/edit/*') ? 'active' : '' }}"> Edit Customer </a></li>
                        <li><a class="{{ set_active(['form/addcustomer/page']) }}" href="{{ route('form/addcustomer/page') }}"> Add Customer </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Rooms </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['form/allrooms/page']) }}" href="{{ route('form/allrooms/page') }}">All Rooms </a></li>
                        <li><a class="{{ request()->is('form/room/edit/*') ? 'active' : '' }}"> Edit Rooms </a></li>
                        <li><a class="{{ set_active(['form/addroom/page']) }}" href="{{ route('form/addroom/page') }}"> Add Rooms </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a  class="{{ set_active(['form/emplyee/list']) }}" href="{{ route('form/emplyee/list') }}">Employees List </a></li>
                        <li><a  class="{{ set_active(['form/employee/add']) }}" href="{{ route('form/employee/add') }}">Employees Add </a></li>
                        <li><a  class="{{ set_active(['form/leaves/page']) }}" href="{{ route('form/leaves/page') }}">Leaves </a></li>
                        <li><a href="holidays.html">Holidays </a></li>
                        <li><a href="attendance.html">Attendance </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="invoices.html">Invoices </a></li>
                        <li><a href="payments.html">Payments </a></li>
                        <li><a href="expenses.html">Expenses </a></li>
                        <li><a href="taxes.html">Taxes </a></li>
                        <li><a href="provident-fund.html">Provident Fund </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-book"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="salary.html">Employee Salary </a></li>
                        <li><a href="salary-veiw.html">Payslip </a></li>
                    </ul>
                </li> --}}
                <li class="submenu"> <a href="#"></i><i class="fas fa-database mr-2"></i><span> Master Data </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['matauang/list/page']) }}" href="{{ route('matauang/list/page') }}"><i class="fas fa-money-check-alt mr-3"></i>Mata Uang</a></li>
                        <li><a class="{{ set_active(['cabang/list/page']) }}" href="{{ route('cabang/list/page') }}"><i class="fas fa-warehouse ml-0 mr-3"></i>Cabang</a></li>
                        <li><a class="{{ set_active(['statuspemasok/list/page']) }}" href="{{ route('statuspemasok/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>Status Pelanggan & Pemasok</a></li>
                        <li><a class="{{ set_active(['tipepelanggan/list/page']) }}" href="{{ route('tipepelanggan/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>Tipe Pelanggan</a></li>
                        <li><a class="{{ set_active(['pelanggan/list/page']) }}" href="{{ route('pelanggan/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>Pelanggan</a></li>
                        <li><a class="{{ set_active(['pegawai/list/page']) }}" href="{{ route('pegawai/list/page') }}"><i class="fas fa-briefcase ml-0 mr-3"></i>Pegawai</a></li>
                        {{-- <li><a class="{{ set_active(['konsumen/list/page']) }}" href="{{ route('konsumen/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>Konsumen</a></li> --}}
                        <li><a class="{{ set_active(['pemasok/list/page']) }}" href="{{ route('pemasok/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>Pemasok</a></li>
                        <li><a class="{{ set_active(['penjual/list/page']) }}" href="{{ route('penjual/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>Penjual</a></li>
                        <li><a class="{{ set_active(['departemen/list/page']) }}" href="{{ route('departemen/list/page') }}"><i class="fas fa-warehouse ml-0 mr-3"></i>Departemen</a></li>
                        <li class="submenu"> <a href="#"></i> <span> Proyek </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                {{-- <li class="submenu"> <a href="#"></i> <span> Proyek Perumahan </span> <span class="menu-arrow"></span></a>
                                    <ul class="submenu_class" style="display: none;">
                                        <li><a class="{{ set_active(['cluster/list/page']) }}" href="{{ route('cluster/list/page') }}">Cluster</a></li>
                                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Unit</a></li>
                                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Kapling</a></li>
                                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Fasum</a></li>
                                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Fasos</a></li>
                                    </ul>
                                </li> --}}
                                <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Unit</a></li>
                                <li><a class="{{ set_active(['proyekumum/list/page']) }}" href="{{ route('proyekumum/list/page') }}">Proyek UMUM</a></li>
                            </ul>
                        </li>
                        <li><a class="{{ set_active(['syarat/list/page']) }}" href="{{ route('syarat/list/page') }}"><i class="fas fa-money-check-alt mr-3"></i>Syarat Pembayaran</a></li>
                        <li><a class="{{ set_active(['pajak/list/page']) }}" href="{{ route('pajak/list/page') }}"><i class="fas fa-money-check-alt mr-3"></i>Pajak</a></li>
                    </ul>
                </li>

                <li class="submenu"> <a href="#"></i><i class="fas fa-database mr-2"></i><span> Marketing  <span class="badge bg-light text-dark">New!</span></span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['prospek/list/page']) }}" href="{{ route('prospek/list/page') }}"><i class="fas fa-money-check-alt mr-3"></i>Prospek</a></li>
                        <li><a class="{{ set_active(['konsumenmarketing/list/page']) }}" href="{{ route('konsumenmarketing/list/page') }}"><i class="fas fa-warehouse ml-0 mr-3"></i>Konsumen</a></li>
                        @if(Auth::user() && Auth::user()->email === 'user.zacky@gmail.com')
                        <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Perumahan </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="{{ set_active(['siteplane/page'], 1) }}" href="{{ route('siteplane/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Site Plan</a></li>
                                <li><a class="{{ set_active(['klusterperumahan/list/page'], 1) }}" href="{{ route('klusterperumahan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Kluster/Perumahan</a></li>
                                <li><a class="{{ set_active(['kavling/list/page'], 1) }}" href="{{ route('kavling/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Kavling</a></li>
                                <li><a class="{{ set_active(['fasum/list/page'], 1) }}" href="{{ route('fasum/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Fasum</a></li>
                                <li><a class="{{ set_active(['fasos/list/page'], 1) }}" href="{{ route('fasos/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Fasos</a></li>
                            </ul>
                        </li>
                        @else
                        <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Perumahan <span class="badge bg-warning text-dark">Progress</span></span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="disabled" href="javascript:void(0)" style="pointer-events: none; cursor: default; background-color:gray;"><i class="fas fa-box-open ml-0 mr-3"></i>Site Plan - (<strong>DALAM PRODUKSI</strong>)</a></li>
                                <li><a class="disabled" href="javascript:void(0)" style="pointer-events: none; cursor: default; background-color:gray;"><i class="fas fa-box-open ml-0 mr-3"></i>Kluster/Perumahan - (<strong>DALAM PRODUKSI</strong>)</a></li>
                                <li><a class="disabled" href="javascript:void(0)" style="pointer-events: none; cursor: default; background-color:gray;"><i class="fas fa-box-open ml-0 mr-3"></i>Kavling - (<strong>DALAM PRODUKSI</strong>)</a></li>
                                <li><a class="disabled" href="javascript:void(0)" style="pointer-events: none; cursor: default; background-color:gray;"></i>Fasum - (<strong>DALAM PRODUKSI</strong>)</a></li>
                                <li><a class="disabled" href="javascript:void(0)" style="pointer-events: none; cursor: default; background-color:gray;"></i>Fasos - (<strong>DALAM PRODUKSI</strong>)</a></li>
                            </ul>
                        </li>
                        @endif
                        {{-- <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Perumahan </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="{{ set_active(['siteplane/page'], 1) }}" href="{{ route('siteplane/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Site Plan</a></li>
                                <li><a class="{{ set_active(['klusterperumahan/list/page'], 1) }}" href="{{ route('klusterperumahan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Kluster/Perumahan</a></li>
                                <li><a class="{{ set_active(['kavling/list/page'], 1) }}" href="{{ route('kavling/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Kavling</a></li>
                                <li><a class="{{ set_active(['fasum/list/page'], 1) }}" href="{{ route('fasum/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Fasum</a></li>
                                <li><a class="{{ set_active(['fasos/list/page'], 1) }}" href="{{ route('fasos/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Fasos</a></li>
                            </ul>
                        </li> --}}
                        <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Tiket Kostumer </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="{{ set_active(['kategoritiketkostumer/list/page'], 1) }}" href="{{ route('kategoritiketkostumer/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Kategori Tiket Kostumer</a></li>
                                <li><a class="{{ set_active(['tiketkostumer/list/page'], 1) }}" href="{{ route('tiketkostumer/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Tiket Kostumer</a></li>
                            </ul>
                        </li>
                        <li><a class="{{ set_active(['databooking/list/page']) }}" href="{{ route('databooking/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>Data Booking</a></li>
                        <li><a class="{{ set_active(['suratperintahpembangunan/list/page']) }}" href="{{ route('suratperintahpembangunan/list/page') }}"><i class="fas fa-warehouse ml-0 mr-3"></i>Surat Perintah Pembangunan</a></li>
                    </ul>
                </li>

                <li class="submenu"> <a href="#"></i><i class="fas fa-database mr-2"></i><span> Projek </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Lahan </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="{{ set_active(['masterbiayalahan/list/page'], 1) }}" href="{{ route('masterbiayalahan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Master Biaya Lahan</a></li>
                                <li><a class="{{ set_active(['datalahan/list/page'], 1) }}" href="{{ route('datalahan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Data Lahan</a></li>
                            </ul>
                        </li>
                        <li><a class="{{ set_active(['perencanaanpembangunan/list/page']) }}" href="{{ route('perencanaanpembangunan/list/page') }}"><i class="fas fa-money-check-alt mr-3"></i>Perencanaan Pembangunan</a></li>
                        <li><a class="{{ set_active(['spkmandorpekerja/list/page']) }}" href="{{ route('spkmandorpekerja/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>SPK Mandor/Pekerja</a></li>
                        <li><a class="{{ set_active(['rabrap/list/page']) }}" href="{{ route('rabrap/list/page') }}"><i class="fas fa-money-check-alt mr-3"></i>RAB & RAP</a></li>
                        <li><a class="{{ set_active(['pengajuanbahanbangunan/list/page']) }}" href="{{ route('pengajuanbahanbangunan/list/page') }}"><i class="fas fa-box ml-0 mr-3"></i>Pengajuan Bahan Bangunan</a></li>
                        <li><a class="{{ set_active(['pengajuanbahanlainya/list/page']) }}" href="{{ route('pengajuanbahanlainya/list/page') }}"><i class="fas fa-box ml-0 mr-3"></i>Pengajuan Bahan Lainya</a></li>
                        <li><a class="{{ set_active(['kemajuanpembangunan/list/page']) }}" href="{{ route('kemajuanpembangunan/list/page') }}"><i class="fas fa-warehouse ml-0 mr-3"></i>Kemajuan Pembangunan</a></li>
                    </ul>
                </li>

                <li class="submenu"> <a href="#"></i><i class="fas fa-boxes mr-2"></i><span> Modul Utama  <span class="badge bg-light text-dark">New Update!</span></span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Pembelian </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="{{ set_active(['pembelian/permintaan/list/page']) }}" href="{{ route('pembelian/permintaan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Permintaan Pembelian</a></li>
                                <li><a class="{{ set_active(['pembelian/pesanan/list/page']) }}" href="{{ route('pembelian/pesanan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Pesanan Pembelian</a></li>
                                <li><a class="{{ set_active(['pembelian/penerimaan/list/page']) }}" href="{{ route('pembelian/penerimaan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Penerimaan Pembelian</a></li>
                                <li><a class="{{ set_active(['pembelian/faktur/list/page']) }}" href="{{ route('pembelian/faktur/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Faktur Pembelian</a></li>
                                <li><a class="{{ set_active(['pembelian/pembayaran/list/page']) }}" href="{{ route('pembelian/pembayaran/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Pembayaran Pembelian</a></li>
                                <li><a class="{{ set_active(['pembelian/retur/list/page']) }}" href="{{ route('pembelian/retur/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Retur Pembelian</a></li>
                                {{-- <li><a class="{{ set_active(['pembelian/retur/list/page']) }}" href="{{ route('pembelian/retur/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Retur Pembelian<span class="badge bg-light text-dark">Siap dicoba!</span></a></li> --}}
                                {{-- <li>
                                    @if(Auth::user() && Auth::user()->email === 'user.zacky@gmail.com')
                                        <a class="{{ set_active(['pembelian/retur/list/page']) }}" href="{{ route('pembelian/retur/list/page') }}">
                                            <i class="fas fa-box-open ml-0 mr-3"></i>Retur Pembelian
                                        </a>
                                    @else
                                        <a class="disabled" href="javascript:void(0)" style="pointer-events: none; cursor: default; background-color:gray;">
                                            <i class="fas fa-box-open ml-0 mr-3"></i>Retur Pembelian - (<strong>DALAM PRODUKSI</strong>)
                                        </a>
                                    @endif
                                </li> --}}
                            </ul>
                        </li>
                        <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Penjualan </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="{{ request()->is('penjualan.*') ? 'display: block;' : 'display: none;' }}">
                                <li><a class="{{ set_active(['penjualan.penawaran.index'], 1) }}" href="{{ route('penjualan.penawaran_penjualan.index') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Penawaran Penjualan</a></li>
                                <li><a class="{{ set_active(['penjualan.pesanan_penjualan.index'], 1) }}" href="{{ route('penjualan.pesanan_penjualan.index') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Pesanan Penjualan</a></li>
                                <li><a class="{{ set_active(['penjualan.pengiriman_penjualan.index'], 1) }}" href="{{ route('penjualan.pengiriman_penjualan.index') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Pengiriman Penjualan</a></li>
                                <li><a class="{{ set_active(['penjualan.faktur_penjualan.index'], 1) }}" href="{{ route('penjualan.faktur_penjualan.index') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Faktur Penjualan</a></li>
                                <li><a class="{{ set_active(['penjualan.faktur_penagihan.index'], 1) }}" href="{{ route('penjualan.faktur_penagihan.index') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Faktur Penagihan</a></li>
                                <li><a class="{{ set_active(['penjualan.penerimaan_penjualan.index'], 1) }}" href="{{ route('penjualan.penerimaan_penjualan.index') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Penerimaan Penjualan</a></li>
                                <li><a class="{{ set_active(['penjualan.retur_penjualan.index'], 1) }}" href="{{ route('penjualan.retur_penjualan.index') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Retur Penjualan</a></li>
                            </ul>
                        </li>
                        <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Persediaan  <span class="badge bg-light text-dark">New Update!</span></span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="{{ set_active(['satuan/list/page']) }}" href="{{ route('satuan/list/page') }}"><i class="fas fa-database ml-0 mr-3"></i>Satuan</a></li>
                                <li><a class="{{ set_active(['gudang/list/page']) }}" href="{{ route('gudang/list/page') }}"><i class="fas fa-database ml-0 mr-3"></i>Gudang</a></li>
                                <li><a class="{{ set_active(['kategoribarang/list/page']) }}" href="{{ route('kategoribarang/list/page') }}"><i class="fas fa-database ml-0 mr-3"></i>Kategori Barang</a></li>
                                <li><a class="{{ set_active(['barang/list/page']) }}" href="{{ route('barang/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Barang</a></li>
                                <li><a class="{{ set_active(['penyesuaian/list/page']) }}" href="{{ route('penyesuaian/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Penyesuaian Barang</a></li>
                                <li><a class="{{ set_active(['pindahbarang/list/page']) }}" href="{{ route('pindahbarang/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Pindah Barang</a></li>
                                {{-- <li><a class="{{ set_active(['hargajual/list/page']) }}" href="{{ route('hargajual/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Harga Jual</a></li> --}}
                                <li><a class="{{ set_active(['barangpergudang/list/page']) }}" href="{{ route('barangpergudang/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Barang per Gudang</a></li>
                                {{-- <li><a class="{{ set_active(['pembiayaanpesanan/list/page']) }}" href="{{ route('pembiayaanpesanan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Pembiayaan Pesanan</a></li> --}}
                                {{-- <li><a class="{{ set_active(['pencatatannomorserial/list/page']) }}" href="{{ route('pencatatannomorserial/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Pencatatan Nomor Serial</a></li> --}}

                            </ul>
                        </li>
                        <li class="submenu"> <a href="#"></i><i class="fas fa-box ml-0 mr-2"></i><span> Aktiva <span class="badge bg-light text-dark">New!</span></span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="{{ set_active(['penyusutan/list/page']) }}" href="{{ route('penyusutan/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Penyusutan</a></li>
                                <li><a class="{{ set_active(['aktivatetap/list/page']) }}" href="{{ route('aktivatetap/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Aktiva Tetap</a></li>
                                <li><a class="{{ set_active(['tipeaktivatetappajak/list/page']) }}" href="{{ route('tipeaktivatetappajak/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Tipe Aktiva Tetap Pajak</a></li>
                                <li><a class="{{ set_active(['tipeaktivatetap/list/page']) }}" href="{{ route('tipeaktivatetap/list/page') }}"><i class="fas fa-box-open ml-0 mr-3"></i>Tipe Aktiva Tetap</a></li>
                            </ul>
                        </li>
                        {{-- <li><a class="{{ set_active(['pegawai/list/page']) }}" href="{{ route('pegawai/list/page') }}">Pegawai</a></li> --}}
                        {{-- <li><a class="{{ set_active(['matauang/list/page']) }}" href="{{ route('matauang/list/page') }}">Mata Uang</a></li>
                        <li><a class="{{ set_active(['statuspemasok/list/page']) }}" href="{{ route('statuspemasok/list/page') }}">Status Pelanggan & Pemasok</a></li>
                        <li><a class="{{ set_active(['tipepelanggan/list/page']) }}" href="{{ route('tipepelanggan/list/page') }}">Tipe Pelanggan</a></li>
                        <li><a class="{{ set_active(['pelanggan/list/page']) }}" href="{{ route('pelanggan/list/page') }}">Pelanggan</a></li>
                        <li><a class="{{ set_active(['pemasok/list/page']) }}" href="{{ route('pemasok/list/page') }}">Pemasok</a></li>
                        <li><a class="{{ set_active(['penjual/list/page']) }}" href="{{ route('penjual/list/page') }}">Penjual</a></li>
                        <li><a class="{{ set_active(['departemen/list/page']) }}" href="{{ route('departemen/list/page') }}">Departemen</a></li>
                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Proyek</a></li>
                        <li><a class="{{ set_active(['syarat/list/page']) }}" href="{{ route('syarat/list/page') }}">Syarat Pembayaran</a></li>
                        <li><a class="{{ set_active(['pajak/list/page']) }}" href="{{ route('pajak/list/page') }}">Pajak</a></li> --}}
                    </ul>
                </li>
                <li class="submenu"> <a href="#"></i><i class="fas fa-book ml-0 mr-2"></i><span> Buku Besar  <span class="badge bg-light text-dark">New Update!</span></span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['akun/list/page']) }}" href="{{ route('akun/list/page') }}"><i class="fas fa-money-check ml-0 mr-3"></i>Daftar Akun</a></li>
                        <li><a @class(['active' => request()->is('jurnal/*')]) href="{{ route('jurnal/list/page') }}"><i class="fas fa-money-check ml-0 mr-3"></i>Jurnal Umum</a></li>
                        <li><a @class(['active' => request()->is('anggaranakun/*')]) href="{{ route('anggaranakun/list/page') }}"><i class="fas fa-money-check ml-0 mr-3"></i>Anggaran Akun</a></li>
                        <li><a @class(['active' => request()->is('pembayaranlainnya/*')]) href="{{ route('pembayaranlainnya/list/page') }}"><i class="fas fa-money-check ml-0 mr-3"></i>Pembayaran Lainnya</a></li>
                        <li><a @class(['active' => request()->is('penerimaanlainnya/*')]) href="{{ route('penerimaanlainnya/list/page') }}"><i class="fas fa-money-check ml-0 mr-3"></i>Penerimaan Lainnya</a></li>
                        {{-- <li><a class="{{ set_active(['gudang/list/page']) }}" href="{{ route('gudang/list/page') }}">Gudang</a></li>
                        <li><a class="{{ set_active(['kategoribarang/list/page']) }}" href="{{ route('kategoribarang/list/page') }}">Kategori Barang</a></li> --}}
                        {{-- <li><a class="{{ set_active(['pegawai/list/page']) }}" href="{{ route('pegawai/list/page') }}">Pegawai</a></li> --}}
                        {{-- <li><a class="{{ set_active(['matauang/list/page']) }}" href="{{ route('matauang/list/page') }}">Mata Uang</a></li>
                        <li><a class="{{ set_active(['statuspemasok/list/page']) }}" href="{{ route('statuspemasok/list/page') }}">Status Pelanggan & Pemasok</a></li>
                        <li><a class="{{ set_active(['tipepelanggan/list/page']) }}" href="{{ route('tipepelanggan/list/page') }}">Tipe Pelanggan</a></li>
                        <li><a class="{{ set_active(['pelanggan/list/page']) }}" href="{{ route('pelanggan/list/page') }}">Pelanggan</a></li>
                        <li><a class="{{ set_active(['pemasok/list/page']) }}" href="{{ route('pemasok/list/page') }}">Pemasok</a></li>
                        <li><a class="{{ set_active(['penjual/list/page']) }}" href="{{ route('penjual/list/page') }}">Penjual</a></li>
                        <li><a class="{{ set_active(['departemen/list/page']) }}" href="{{ route('departemen/list/page') }}">Departemen</a></li>
                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Proyek</a></li>
                        <li><a class="{{ set_active(['syarat/list/page']) }}" href="{{ route('syarat/list/page') }}">Syarat Pembayaran</a></li>
                        <li><a class="{{ set_active(['pajak/list/page']) }}" href="{{ route('pajak/list/page') }}">Pajak</a></li> --}}
                    </ul>
                </li>
                <li class="submenu"> <a href="#"></i><i class="fas fa-clipboard ml-0 mr-2"></i><span>Laporan  <span class="badge bg-light text-dark">New!</span></span><span class="menu-arrow"></span></a>
                    <ul class="submenu_class">
                        <li>
                            <a @class(['active' => request()->is('laporan*')]) href="{{ route('laporan') }}">
                                <i class="fas fa-clipboard ml-0 mr-2"></i>
                                Semua Laporan
                            </a>
                        </li>
                        {{-- {{-- <li><a class="{{ set_active(['gudang/list/page']) }}" href="{{ route('gudang/list/page') }}">Gudang</a></li> --}}
                        {{-- <li><a class="{{ set_active(['pegawai/list/page']) }}" href="{{ route('pegawai/list/page') }}">Pegawai</a></li> --}}
                        {{-- <li><a class="{{ set_active(['matauang/list/page']) }}" href="{{ route('matauang/list/page') }}">Mata Uang</a></li>
                        <li><a class="{{ set_active(['statuspemasok/list/page']) }}" href="{{ route('statuspemasok/list/page') }}">Status Pelanggan & Pemasok</a></li>
                        <li><a class="{{ set_active(['tipepelanggan/list/page']) }}" href="{{ route('tipepelanggan/list/page') }}">Tipe Pelanggan</a></li>
                        <li><a class="{{ set_active(['pelanggan/list/page']) }}" href="{{ route('pelanggan/list/page') }}">Pelanggan</a></li>
                        <li><a class="{{ set_active(['pemasok/list/page']) }}" href="{{ route('pemasok/list/page') }}">Pemasok</a></li>
                        <li><a class="{{ set_active(['penjual/list/page']) }}" href="{{ route('penjual/list/page') }}">Penjual</a></li>
                        <li><a class="{{ set_active(['departemen/list/page']) }}" href="{{ route('departemen/list/page') }}">Departemen</a></li>
                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Proyek</a></li>
                        <li><a class="{{ set_active(['syarat/list/page']) }}" href="{{ route('syarat/list/page') }}">Syarat Pembayaran</a></li>
                        <li><a class="{{ set_active(['pajak/list/page']) }}" href="{{ route('pajak/list/page') }}">Pajak</a></li> --}}
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fas fa-user mr-2"></i><span>Pengguna </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="submenu_class" style="display: none;">
                        {{-- <li><a class="{{ set_active(['users/add/new']) }}" href="{{ route('users/add/new') }}">Add User</a></li> --}}
                        <li><a class="{{ set_active(['users/list/page']) }}" href="{{ route('users/list/page') }}"><i class="fas fa-users ml-0 mr-3"></i>Data Pengguna</a></li>
                        {{-- <li><a class="{{ request()->is('users/add/edit/*') ? 'active' : '' }}"> Edit User </a></li> --}}
                    </ul>
                </li>
            </ul>
        </div>
        {{-- <div id="sidebar-menu" class="sidebar-menu">
            <ul> --}}
            {{-- <li class="{{ set_active(['home_2']) }}"> <a href="{{ route('/home_2') }}"><span>Dashboard 2</span></a> </li> --}}
                {{-- <li class="list-divider"></li> --}}
                {{-- <li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['form/allbooking']) }}" href="{{ route('form/allbooking') }}"> All Booking </a></li>
                        <li><a class="{{ request()->is('form/booking/edit/*') ? 'active' : '' }}"> Edit Booking </a></li>
                        <li><a class="{{ set_active(['form/booking/add']) }}" href="{{ route('form/booking/add') }}"> Add Booking </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Customers </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['form/allcustomers/page']) }}" href="{{ route('form/allcustomers/page') }}"> All customers </a></li>
                        <li><a class="{{ request()->is('form/customer/edit/*') ? 'active' : '' }}"> Edit Customer </a></li>
                        <li><a class="{{ set_active(['form/addcustomer/page']) }}" href="{{ route('form/addcustomer/page') }}"> Add Customer </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Rooms </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['form/allrooms/page']) }}" href="{{ route('form/allrooms/page') }}">All Rooms </a></li>
                        <li><a class="{{ request()->is('form/room/edit/*') ? 'active' : '' }}"> Edit Rooms </a></li>
                        <li><a class="{{ set_active(['form/addroom/page']) }}" href="{{ route('form/addroom/page') }}"> Add Rooms </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a  class="{{ set_active(['form/emplyee/list']) }}" href="{{ route('form/emplyee/list') }}">Employees List </a></li>
                        <li><a  class="{{ set_active(['form/employee/add']) }}" href="{{ route('form/employee/add') }}">Employees Add </a></li>
                        <li><a  class="{{ set_active(['form/leaves/page']) }}" href="{{ route('form/leaves/page') }}">Leaves </a></li>
                        <li><a href="holidays.html">Holidays </a></li>
                        <li><a href="attendance.html">Attendance </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="invoices.html">Invoices </a></li>
                        <li><a href="payments.html">Payments </a></li>
                        <li><a href="expenses.html">Expenses </a></li>
                        <li><a href="taxes.html">Taxes </a></li>
                        <li><a href="provident-fund.html">Provident Fund </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-book"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="salary.html">Employee Salary </a></li>
                        <li><a href="salary-veiw.html">Payslip </a></li>
                    </ul>
                </li> --}}
                {{-- <li class="submenu"> <a href="#"></i> <span> HRM </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['matauang/list/page']) }}" href="{{ route('matauang/list/page') }}">Mata Uang</a></li>
                        <li><a class="{{ set_active(['statuspemasok/list/page']) }}" href="{{ route('statuspemasok/list/page') }}">Status Pelanggan & Pemasok</a></li>
                        <li><a class="{{ set_active(['tipepelanggan/list/page']) }}" href="{{ route('tipepelanggan/list/page') }}">Tipe Pelanggan</a></li>
                        <li><a class="{{ set_active(['pelanggan/list/page']) }}" href="{{ route('pelanggan/list/page') }}">Pelanggan</a></li>
                        <li><a class="{{ set_active(['pemasok/list/page']) }}" href="{{ route('pemasok/list/page') }}">Pemasok</a></li>
                        <li><a class="{{ set_active(['penjual/list/page']) }}" href="{{ route('penjual/list/page') }}">Penjual</a></li>
                        <li><a class="{{ set_active(['departemen/list/page']) }}" href="{{ route('departemen/list/page') }}">Departemen</a></li>
                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Proyek</a></li>
                        <li><a class="{{ set_active(['syarat/list/page']) }}" href="{{ route('syarat/list/page') }}">Syarat Pembayaran</a></li>
                        <li><a class="{{ set_active(['pajak/list/page']) }}" href="{{ route('pajak/list/page') }}">Pajak</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="submenu"> <a href="#"></i> <span> Marketing </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li class="submenu"> <a href="#"></i> <span> Perumahan </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a class="{{ set_active(['cluster/list/page']) }}" href="{{ route('cluster/list/page') }}">Kluster/Perumahan</a></li>
                            </ul>
                        </li>
                        <li><a class="{{ set_active(['pegawai/list/page']) }}" href="{{ route('pegawai/list/page') }}">Pegawai</a></li>
                        <li><a class="{{ set_active(['matauang/list/page']) }}" href="{{ route('matauang/list/page') }}">Mata Uang</a></li>
                        <li><a class="{{ set_active(['statuspemasok/list/page']) }}" href="{{ route('statuspemasok/list/page') }}">Status Pelanggan & Pemasok</a></li>
                        <li><a class="{{ set_active(['tipepelanggan/list/page']) }}" href="{{ route('tipepelanggan/list/page') }}">Tipe Pelanggan</a></li>
                        <li><a class="{{ set_active(['pelanggan/list/page']) }}" href="{{ route('pelanggan/list/page') }}">Pelanggan</a></li>
                        <li><a class="{{ set_active(['pemasok/list/page']) }}" href="{{ route('pemasok/list/page') }}">Pemasok</a></li>
                        <li><a class="{{ set_active(['penjual/list/page']) }}" href="{{ route('penjual/list/page') }}">Penjual</a></li>
                        <li><a class="{{ set_active(['departemen/list/page']) }}" href="{{ route('departemen/list/page') }}">Departemen</a></li>
                        <li><a class="{{ set_active(['proyek/list/page']) }}" href="{{ route('proyek/list/page') }}">Proyek</a></li>
                        <li><a class="{{ set_active(['syarat/list/page']) }}" href="{{ route('syarat/list/page') }}">Syarat Pembayaran</a></li>
                        <li><a class="{{ set_active(['pajak/list/page']) }}" href="{{ route('pajak/list/page') }}">Pajak</a></li>
                    </ul>
                </li> --}}
            {{-- </ul>
        </div> --}}
    </div>
</div>
