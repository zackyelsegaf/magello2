<?php

use App\Models\PindahBarang;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Home2Controller;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SyaratController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\MataUangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\ProyekUmumController;
use App\Http\Controllers\PindahBarangController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StatusPemasokController;
use App\Http\Controllers\TipePelangganController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PenyesuaianBarangController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\JasaPengirimanController;
use App\Http\Controllers\PermintaanPembelianController;
use App\Http\Controllers\ModulUtama\PembelianController;
use App\Http\Controllers\ModulUtama\PenjualanController;
use App\Livewire\BarangForm;
use App\Livewire\DepartemenForm;
use App\Livewire\GudangForm;
use App\Livewire\JasaPengirimanForm;
use App\Livewire\KategoriBarangForm;
use App\Livewire\MataUangForm;
use App\Livewire\PajakForm;
use App\Livewire\PelangganForm;
use App\Livewire\PemasokForm;
use App\Livewire\PenjualForm;
use App\Livewire\SatuanForm;
use App\Livewire\StatusPemasokForm;
use App\Livewire\SyaratForm;
use App\Livewire\TipePelangganForm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
    Route::get('home', function () {
        return view('home');
    });
});

Auth::routes();

// ----------------------------- main dashboard ------------------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/profile', 'profile')->name('profile');
});

Route::controller(Home2Controller::class)->group(function () {
    Route::get('/home_2', 'home_2')->name('/home_2');
    // Route::get('/profile', 'profile')->name('profile');
});

// -----------------------------login----------------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

// ------------------------------ register ---------------------------------//
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeUser')->name('register');
});

// ----------------------------- forget password ----------------------------//
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forget-password', 'getEmail')->name('forget-password');
    Route::post('forget-password', 'postEmail')->name('forget-password');
});

// ----------------------------- reset password -----------------------------//
Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('reset-password/{token}', 'getPassword');
    Route::post('reset-password', 'updatePassword');
});

// ----------------------------- booking -----------------------------//
// Route::controller(BookingController::class)->group(function () {
//     Route::get('form/allbooking', 'allbooking')->name('form/allbooking')->middleware('auth');
//     Route::get('form/booking/edit/{bkg_id}', 'bookingEdit')->middleware('auth');
//     Route::get('form/booking/add', 'bookingAdd')->middleware('auth')->name('form/booking/add');
//     Route::post('form/booking/save', 'saveRecord')->middleware('auth')->name('form/booking/save');
//     Route::post('form/booking/update', 'updateRecord')->middleware('auth')->name('form/booking/update');
//     Route::post('form/booking/delete', 'deleteRecord')->middleware('auth')->name('form/booking/delete');
//     Route::post('form/booking/bulk-delete', 'BookingController@bulkDelete')->name('booking.bulk_delete');
// });

// ---------------------------- customers --------------------------//
Route::controller(CustomerController::class)->group(function () {
    Route::get('form/allcustomers/page', 'allCustomers')->middleware('auth')->name('form/allcustomers/page');
    Route::get('form/addcustomer/page', 'addCustomer')->middleware('auth')->name('form/addcustomer/page');
    Route::post('form/addcustomer/save', 'saveCustomer')->middleware('auth')->name('form/addcustomer/save');
    Route::get('form/customer/edit/{bkg_customer_id}', 'updateCustomer')->middleware('auth');
    Route::post('form/customer/update', 'updateRecord')->middleware('auth')->name('form/customer/update');
    Route::post('form/customer/delete', 'deleteRecord')->middleware('auth')->name('form/customer/delete');
});

// ----------------------------- rooms -----------------------------//
Route::controller(RoomsController::class)->group(function () {
    Route::get('form/allrooms/page', 'allrooms')->middleware('auth')->name('form/allrooms/page');
    Route::get('form/addroom/page', 'addRoom')->middleware('auth')->name('form/addroom/page');
    Route::get('form/room/edit/{bkg_room_id}', 'editRoom')->middleware('auth');
    Route::post('form/room/save', 'saveRecordRoom')->middleware('auth')->name('form/room/save');
    Route::post('form/room/delete', 'deleteRecord')->middleware('auth')->name('form/room/delete');
    Route::post('form/room/update', 'updateRecord')->middleware('auth')->name('form/room/update');
});

// ----------------------- user management -------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('users/list/page', 'userList')->middleware('auth')->name('users/list/page');
    Route::get('users/add/new', 'userAddNew')->middleware('auth')->name('users/add/new');
    /** add new users */
    Route::get('users/add/edit/{user_id}', 'userView');
    /** add new users */
    Route::post('users/update', 'userUpdate')->name('users/update');
    /** update record */
    Route::get('users/edit/{id}', [UserManagementController::class, 'edit'])->name('usermanagement.edit');
    Route::post('users/update', [UserManagementController::class, 'update'])->name('usermanagement.update');
    Route::get('users/delete/{id}', 'userDelete')->name('users/delete');
    /** delere record */
    Route::get('get-users-data', 'getUsersData')->name('get-users-data');
    /** get all data users */
});

// ----------------------------- employee -----------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('form/emplyee/list', 'employeesList')->middleware('auth')->name('form/emplyee/list');
    Route::get('form/employee/add', 'employeesAdd')->middleware('auth')->name('form/employee/add');
    Route::get('form/leaves/page', 'leavesPage')->middleware('auth')->name('form/leaves/page');
});

// ----------------------------- matauang -----------------------------//
Route::get('matauang/add/new', MataUangForm::class)->middleware('auth')->name('matauang/add/new');
Route::get('/matauang/edit/{id}', MataUangForm::class)->name('matauang.edit');
Route::controller(MataUangController::class)->group(function () {
    Route::get('matauang/list/page', 'mataUangList')->middleware('auth')->name('matauang/list/page');
    Route::post('/matauang/delete', 'delete')->name('matauang.delete');
    Route::get('get-matauang-data', 'getMataUang')->name('get-matauang-data');
});

//-------------------------------- Status Pemasok ---------------------------------//
Route::get('statuspemasok/add/new', StatusPemasokForm::class)->middleware('auth')->name('statuspemasok/add/new');
Route::get('/statuspemasok/edit/{id}', StatusPemasokForm::class)->name('statuspemasok/edit');
Route::controller(StatusPemasokController::class)->group(function () {
    Route::get('statuspemasok/list/page', 'statusPemasokList')->middleware('auth')->name('statuspemasok/list/page');
    Route::post('/statuspemasok/delete', 'delete')->name('statuspemasok/delete');
    Route::get('get-statuspemasok-data', 'getStatusPemasok')->name('get-statuspemasok-data');
});

//-------------------------------- Pemasok ---------------------------------//
Route::get('pemasok/add/new', PemasokForm::class)->middleware('auth')->name('pemasok/add/new');
Route::get('/pemasok/edit/{id}', PemasokForm::class)->name('pemasok/edit');
Route::controller(PemasokController::class)->group(function () {
    Route::get('pemasok/list/page', 'PemasokList')->middleware('auth')->name('pemasok/list/page');
    Route::post('/pemasok/delete', 'delete')->name('pemasok/delete');
    Route::get('get-pemasok-data', 'getPemasok')->name('get-pemasok-data');
});

//-------------------------------- Syarat Pembayaran ---------------------------------//
Route::get('syarat/add/new', SyaratForm::class)->middleware('auth')->name('syarat/add/new');
Route::get('/syarat/edit/{id}', SyaratForm::class)->name('syarat/edit');
Route::controller(SyaratController::class)->group(function () {
    Route::get('syarat/list/page', 'syaratList')->middleware('auth')->name('syarat/list/page');
    Route::post('/syarat/delete', 'delete')->name('syarat/delete');
    Route::get('get-syarat-data', 'getSyarat')->name('get-syarat-data');
});

//-------------------------------- Pajak ---------------------------------//
Route::get('pajak/add/new', PajakForm::class)->middleware('auth')->name('pajak/add/new');
Route::get('/pajak/edit/{id}', PajakForm::class)->name('pajak/edit');
Route::controller(PajakController::class)->group(function () {
    Route::get('pajak/list/page', 'pajakList')->middleware('auth')->name('pajak/list/page');
    Route::post('/pajak/delete', 'delete')->name('pajak/delete');
    Route::get('get-pajak-data', 'getPajak')->name('get-pajak-data');
});

//-------------------------------- Jasa Pengiriman ---------------------------------//
Route::get('jasapengiriman/add/new', JasaPengirimanForm::class)->middleware('auth')->name('jasapengiriman/add/new');
Route::get('/jasapengiriman/edit/{id}', JasaPengirimanForm::class)->name('jasapengiriman/edit');
Route::controller(JasaPengirimanController::class)->group(function () {
    Route::get('jasapengiriman/list/page', 'jasaPengirimanList')->middleware('auth')->name('jasapengiriman/list/page');
    Route::post('/jasapengiriman/delete', 'delete')->name('jasapengiriman/delete');
    Route::get('get-jasapengiriman-data', 'getJasaPengiriman')->name('get-jasapengiriman-data');
});

//-------------------------------- TIPE PELANGGAN ---------------------------------//
Route::get('tipepelanggan/add/new', TipePelangganForm::class)->middleware('auth')->name('tipepelanggan/add/new');
Route::get('/tipepelanggan/edit/{id}', TipePelangganForm::class)->name('tipepelanggan/edit');
Route::controller(TipePelangganController::class)->group(function () {
    Route::get('tipepelanggan/list/page', 'tipePelangganList')->middleware('auth')->name('tipepelanggan/list/page');
    Route::post('/tipepelanggan/delete', 'delete')->name('tipepelanggan/delete');
    Route::get('get-tipepelanggan-data', 'getTipePelanggan')->name('get-tipepelanggan-data');
});

//-------------------------------- PELANGGAN ---------------------------------//
Route::get('pelanggan/add/new', PelangganForm::class)->middleware('auth')->name('pelanggan/add/new');
Route::get('/pelanggan/edit/{id}/{pelanggan_id}', PelangganForm::class)->name('pelanggan/edit');
Route::controller(PelangganController::class)->group(function () {
    Route::get('pelanggan/list/page', 'PelangganList')->middleware('auth')->name('pelanggan/list/page');
    Route::post('/pelanggan/delete', 'delete')->name('pelanggan/delete');
    Route::get('get-pelanggan-data', 'getPelanggan')->name('get-pelanggan-data');
});

//-------------------------------- PENJUAL ---------------------------------//
Route::get('penjual/add/new', PenjualForm::class)->middleware('auth')->name('penjual/add/new');
Route::get('/penjual/edit/{id}', PenjualForm::class)->name('penjual/edit');
Route::controller(PenjualController::class)->group(function () {
    Route::get('penjual/list/page', 'penjualList')->middleware('auth')->name('penjual/list/page');
    Route::post('/penjual/delete', 'delete')->name('penjual/delete');
    Route::get('get-penjual-data', 'getPenjual')->name('get-penjual-data');
});

//-------------------------------- DEPARTEMEN ---------------------------------//
Route::get('departemen/add/new', DepartemenForm::class)->middleware('auth')->name('departemen/add/new');
Route::get('/departemen/edit/{id}/{departemen_id}', DepartemenForm::class)->name('departemen/edit');
Route::controller(DepartemenController::class)->group(function () {
    Route::get('departemen/list/page', 'DepartemenList')->middleware('auth')->name('departemen/list/page');
    Route::post('/departemen/delete', 'delete')->name('departemen/delete');
    Route::get('get-departemen-data', 'getDepartemen')->name('get-departemen-data');
});

Route::controller(ProyekController::class)->group(function () {
    Route::get('proyek/list/page', 'ProyekList')->middleware('auth')->name('proyek/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('proyek/add/new', 'ProyekAddNew')->middleware('auth')->name('proyek/add/new');
    Route::post('form/proyek/save', 'saveRecordProyek')->middleware('auth')->name('form/proyek/save');
    Route::get('/proyek/edit/{id}/{proyek_id}', [ProyekController::class, 'edit'])->name('proyek/edit');
    Route::post('/proyek/update/{proyek_id}', [ProyekController::class, 'update'])->name('proyek/update');
    Route::post('/proyek/delete', [ProyekController::class, 'delete'])->name('proyek/delete');
    Route::get('get-proyek-data', [ProyekController::class, 'getProyek'])->name('get-proyek-data');
    // Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
    // Route::get('cities', 'DependentDropdownController@cities')->name('cities');
});

Route::controller(PegawaiController::class)->group(function () {
    Route::get('pegawai/list/page', 'pegawaiList')->middleware('auth')->name('pegawai/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('pegawai/add/new', 'PegawaiAddNew')->middleware('auth')->name('pegawai/add/new');
    Route::post('form/pegawai/save', 'saveRecordPegawai')->middleware('auth')->name('form/pegawai/save');
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai/edit');
    Route::post('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai/update');
    Route::post('/pegawai/delete', [PegawaiController::class, 'delete'])->name('pegawai/delete');
    Route::get('get-pegawai-data', [PegawaiController::class, 'getPegawai'])->name('get-pegawai-data');
});

//-------------------------------- SATUAN ---------------------------------//
Route::get('satuan/add/new', SatuanForm::class)->middleware('auth')->name('satuan/add/new');
Route::get('/satuan/edit/{id}', SatuanForm::class)->name('satuan/edit');
Route::controller(SatuanController::class)->group(function () {
    Route::get('satuan/list/page', 'satuanList')->middleware('auth')->name('satuan/list/page');
    Route::post('/satuan/delete', 'delete')->name('satuan/delete');
    Route::get('get-satuan-data', 'getSatuan')->name('get-satuan-data');
});

//-------------------------------- GUDANG ---------------------------------//
Route::get('gudang/add/new', GudangForm::class)->middleware('auth')->name('gudang/add/new');
Route::get('/gudang/edit/{id}', GudangForm::class)->name('gudang/edit');
Route::controller(GudangController::class)->group(function () {
    Route::get('gudang/list/page', 'gudangList')->middleware('auth')->name('gudang/list/page');
    Route::post('/gudang/delete', 'delete')->name('gudang/delete');
    Route::get('get-gudang-data', 'getGudang')->name('get-gudang-data');
});

//-------------------------------- KATEGORI BARANG ---------------------------------//
Route::get('kategoribarang/add/new', KategoriBarangForm::class)->middleware('auth')->name('kategoribarang/add/new');
Route::get('/kategoribarang/edit/{id}', KategoriBarangForm::class)->name('kategoribarang/edit');
Route::controller(KategoriBarangController::class)->group(function () {
    Route::get('kategoribarang/list/page', 'kategoriBarangList')->middleware('auth')->name('kategoribarang/list/page');
    Route::post('/kategoribarang/delete', 'delete')->name('kategoribarang/delete');
    Route::get('get-kategoribarang-data', 'getKategoriBarang')->name('get-kategoribarang-data');
});

Route::get('barang/add/new', BarangForm::class)->middleware('auth')->name('barang/add/new');
Route::get('/barang/edit/{id}', BarangForm::class)->name('barang/edit');
Route::controller(BarangController::class)->group(function () {
    Route::get('barang/list/page', 'daftarBarang')->middleware('auth')->name('barang/list/page');
    Route::post('form/barang/save', 'simpanBarang')->middleware('auth')->name('form/barang/save');
    Route::post('/barang/update/{id}', [BarangController::class, 'updateBarang'])->name('barang/update');
    Route::post('/barang/delete', [BarangController::class, 'hapusBarang'])->name('barang/delete');
    Route::get('get-barang-data', [BarangController::class, 'dataBarang'])->name('get-barang-data');
});

Route::controller(ClusterController::class)->group(function () {
    Route::get('cluster/list/page', 'daftarCluster')->middleware('auth')->name('cluster/list/page');
    Route::get('cluster/add/new', 'tambahCluster')->middleware('auth')->name('cluster/add/new');
    Route::post('form/cluster/save', 'simpanCluster')->middleware('auth')->name('form/cluster/save');
    Route::get('/cluster/edit/{id}', [ClusterController::class, 'editCluster'])->name('cluster/edit');
    Route::post('/cluster/update/{id}', [ClusterController::class, 'updateCluster'])->name('cluster/update');
    Route::post('/cluster/delete', [ClusterController::class, 'hapusCluster'])->name('cluster/delete');
    Route::get('get-cluster-data', [ClusterController::class, 'dataCluster'])->name('get-cluster-data');
});

Route::controller(KonsumenController::class)->group(function () {
    Route::get('konsumen/list/page', 'daftarKonsumen')->middleware('auth')->name('konsumen/list/page');
    Route::get('konsumen/add/new', 'tambahKonsumen')->middleware('auth')->name('konsumen/add/new');
    Route::post('form/konsumen/save', 'simpanKonsumen')->middleware('auth')->name('form/konsumen/save');
    Route::get('/konsumen/edit/{id}', [KonsumenController::class, 'editKonsumen'])->name('konsumen/edit');
    Route::post('/konsumen/update/{id}', [KonsumenController::class, 'updateKonsumen'])->name('konsumen/update');
    Route::post('/konsumen/delete', [KonsumenController::class, 'hapusKonsumen'])->name('konsumen/delete');
    Route::get('get-konsumen-data', [KonsumenController::class, 'dataKonsumen'])->name('get-konsumen-data');
});

Route::controller(ProyekUmumController::class)->group(function () {
    Route::get('proyekumum/list/page', 'daftarProyekUmum')->middleware('auth')->name('proyekumum/list/page');
    Route::get('proyekumum/add/new', 'tambahProyekUmum')->middleware('auth')->name('proyekumum/add/new');
    Route::post('form/proyekumum/save', 'simpanProyekUmum')->middleware('auth')->name('form/proyekumum/save');
    Route::get('/proyekumum/edit/{id}', [ProyekUmumController::class, 'editProyekUmum'])->name('proyekumum/edit');
    Route::post('/proyekumum/update/{id}', [ProyekUmumController::class, 'updateProyekUmum'])->name('proyekumum/update');
    Route::post('/proyekumum/delete', [ProyekUmumController::class, 'hapusProyekUmum'])->name('proyekumum/delete');
    Route::get('get-proyekumum-data', [ProyekUmumController::class, 'dataProyekUmum'])->name('get-proyekumum-data');
});

Route::controller(PenyesuaianBarangController::class)->group(function () {
    Route::get('penyesuaian/list/page', 'daftarPenyesuaian')->middleware('auth')->name('penyesuaian/list/page');
    Route::get('penyesuaian/add/new', 'tambahPenyesuaian')->middleware('auth')->name('penyesuaian/add/new');
    Route::post('form/penyesuaian/save', 'simpanPenyesuaian')->middleware('auth')->name('form/penyesuaian/save');
    Route::get('/penyesuaian/edit/{id}/{no_penyesuaian}', 'editPenyesuaian')->middleware('auth')->name('penyesuaian/edit');
    Route::post('/penyesuaian/update/{id}', 'updatePenyesuaian')->middleware('auth')->name('penyesuaian/update');
    Route::post('/penyesuaian/delete', 'hapusPenyesuaian')->middleware('auth')->name('penyesuaian/delete');
    Route::get('get-penyesuaian-data', 'dataPenyesuaian')->name('get-penyesuaian-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});


Route::controller(PindahBarangController::class)->group(function () {
    Route::get('pindahbarang/list/page', 'daftarPindahBarang')->middleware('auth')->name('pindahbarang/list/page');
    Route::get('pindahbarang/add/new', 'tambahPindahBarang')->middleware('auth')->name('pindahbarang/add/new');
    Route::post('form/pindahbarang/save', 'simpanPindahBarang')->middleware('auth')->name('form/pindahbarang/save');
    Route::get('/pindahbarang/edit/{id}/{no_pindah}', 'editPindahBarang')->middleware('auth')->name('pindahbarang/edit');
    Route::post('/pindahbarang/update/{id}', 'updatePindahBarang')->middleware('auth')->name('pindahbarang/update');
    Route::post('/pindahbarang/delete', 'hapusPindahBarang')->middleware('auth')->name('pindahbarang/delete');
    Route::get('get-pindahbarang-data', 'dataPindahBarang')->name('get-pindahbarang-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});

Route::controller(PermintaanPembelianController::class)->group(function () {
    Route::get('pembelian/permintaan/list/page', 'daftarPermintaan')->middleware('auth')->name('pembelian/permintaan/list/page');
    Route::get('pembelian/permintaan/add/new', 'tambahPermintaan')->middleware('auth')->name('pembelian/permintaan/add/new');
    Route::post('form/pembelian/permintaan/save', 'simpanPermintaan')->middleware('auth')->name('form/pembelian/permintaan/save');
    Route::get('/pembelian/permintaan/edit/{id}/{no_permintaan}', 'editPermintaan')->middleware('auth')->name('pembelian/permintaan/edit');
    Route::post('/pembelian/permintaan/update/{id}', 'updatePermintaan')->middleware('auth')->name('pembelian/permintaan/update');
    Route::post('/pembelian/permintaan/delete', 'hapusPermintaan')->middleware('auth')->name('pembelian/permintaan/delete');
    Route::get('get-permintaan-data', 'dataPermintaan')->name('get-permintaan-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});

Route::prefix('pembelian')->controller(PembelianController::class)->group(function () {
    // Permintaan Pembelian
    Route::get('permintaan', 'indexPermintaan')->name('permintaanpembelian.index');
    Route::get('permintaan/create', 'createPermintaan')->name('permintaanpembelian.create');
    Route::post('permintaan', 'storePermintaan')->name('permintaanpembelian.store');
    Route::get('permintaan/{id}/edit', 'editPermintaan')->name('permintaanpembelian.edit');
    Route::put('permintaan/{id}', 'updatePermintaan')->name('permintaanpembelian.update');
    Route::delete('permintaan/{id}', 'destroyPermintaan')->name('permintaanpembelian.destroy');

    // Pesanan Pembelian
    Route::get('pesanan', 'indexPesanan')->name('pesananpembelian.index');
    Route::get('pesanan/create', 'createPesanan')->name('pesananpembelian.create');
    Route::post('pesanan', 'storePesanan')->name('pesananpembelian.store');
    Route::get('pesanan/{id}/edit', 'editPesanan')->name('pesananpembelian.edit');
    Route::put('pesanan/{id}', 'updatePesanan')->name('pesananpembelian.update');
    Route::delete('pesanan/{id}', 'destroyPesanan')->name('pesananpembelian.destroy');

    // Penerimaan Barang
    Route::get('penerimaan', 'indexPenerimaan')->name('penerimaanbarang.index');
    Route::get('penerimaan/create', 'createPenerimaan')->name('penerimaanbarang.create');
    Route::post('penerimaan', 'storePenerimaan')->name('penerimaanbarang.store');
    Route::get('penerimaan/{id}/edit', 'editPenerimaan')->name('penerimaanbarang.edit');
    Route::put('penerimaan/{id}', 'updatePenerimaan')->name('penerimaanbarang.update');
    Route::delete('penerimaan/{id}', 'destroyPenerimaan')->name('penerimaanbarang.destroy');

    // Faktur Pembelian
    Route::get('faktur', 'indexFaktur')->name('fakturpembelian.index');
    Route::get('faktur/create', 'createFaktur')->name('fakturpembelian.create');
    Route::post('faktur', 'storeFaktur')->name('fakturpembelian.store');
    Route::get('faktur/{id}/edit', 'editFaktur')->name('fakturpembelian.edit');
    Route::put('faktur/{id}', 'updateFaktur')->name('fakturpembelian.update');
    Route::delete('faktur/{id}', 'destroyFaktur')->name('fakturpembelian.destroy');

    // Pembayaran Pembelian
    Route::get('pembayaran', 'indexPembayaran')->name('pembayaranpembelian.index');
    Route::get('pembayaran/create', 'createPembayaran')->name('pembayaranpembelian.create');
    Route::post('pembayaran', 'storePembayaran')->name('pembayaranpembelian.store');
    Route::get('pembayaran/{id}/edit', 'editPembayaran')->name('pembayaranpembelian.edit');
    Route::put('pembayaran/{id}', 'updatePembayaran')->name('pembayaranpembelian.update');
    Route::delete('pembayaran/{id}', 'destroyPembayaran')->name('pembayaranpembelian.destroy');

    // Retur Pembelian
    Route::get('retur', 'indexRetur')->name('returpembelian.index');
    Route::get('retur/create', 'createRetur')->name('returpembelian.create');
    Route::post('retur', 'storeRetur')->name('returpembelian.store');
    Route::get('retur/{id}/edit', 'editRetur')->name('returpembelian.edit');
    Route::put('retur/{id}', 'updateRetur')->name('returpembelian.update');
    Route::delete('retur/{id}', 'destroyRetur')->name('returpembelian.destroy');
});

require 'penjualan.php';
require 'laporan.php';
require 'aktiva.php';
require 'buku_besar.php';
