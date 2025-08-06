<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/penjualan.php';
require __DIR__.'/laporan.php';
require __DIR__.'/buku_besar.php';
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Home2Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\MataUangController;
use App\Http\Controllers\StatusPemasokController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\SyaratController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\TipePelangganController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\ProyekUmumController;
use App\Http\Controllers\PenyesuaianBarangController;
use App\Http\Controllers\PermintaanPembelianController;
use App\Http\Controllers\PesananPembelianController;
use App\Http\Controllers\PenerimaanPembelianController;
use App\Http\Controllers\PindahBarangController;
use App\Http\Controllers\FakturPembelianController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\PembayaranPembelianController;
use App\Http\Controllers\ReturPembelianController;
use App\Http\Controllers\Aktiva\AktivaTetapController;
use App\Http\Controllers\Aktiva\TipeAktivaTetapController;
use App\Http\Controllers\Aktiva\TipeAktivaTetapPajakController;
use App\Http\Controllers\Aktiva\PenyusutanController;
use App\Http\Controllers\JasaPengirimanController;
use App\Http\Controllers\Marketing\DataBookingController;
use App\Http\Controllers\Marketing\KonsumenMarketingController;
use App\Http\Controllers\Marketing\Perumahan\FasosController;
use App\Http\Controllers\Marketing\Perumahan\FasumController;
use App\Http\Controllers\Marketing\Perumahan\KavlingController;
use App\Http\Controllers\Marketing\Perumahan\KlusterPerumahanController;
use App\Http\Controllers\Marketing\Perumahan\SitePlanController;
use App\Http\Controllers\Marketing\ProspekController;
use App\Http\Controllers\Marketing\SuratPerintahPembangunanController;
use App\Http\Controllers\Marketing\TiketKostumer\KategoriTiketKostumerController;
use App\Http\Controllers\Marketing\TiketKostumer\TiketKostumerController;
use App\Http\Controllers\Persediaan\HargaJualController;
use App\Http\Controllers\Persediaan\BarangPerGudangController;
use App\Http\Controllers\Persediaan\PembiayaanPesananController;
use App\Http\Controllers\Persediaan\PencatatanNomorSerialController;
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
use App\Models\PindahBarang;
use App\Models\Room;
use App\Models\TipeAktivaTetapPajak;


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

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
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
// Route::controller(CustomerController::class)->group(function () {
//     Route::get('form/allcustomers/page', 'allCustomers')->middleware('auth')->name('form/allcustomers/page');
//     Route::get('form/addcustomer/page', 'addCustomer')->middleware('auth')->name('form/addcustomer/page');
//     Route::post('form/addcustomer/save', 'saveCustomer')->middleware('auth')->name('form/addcustomer/save');
//     Route::get('form/customer/edit/{bkg_customer_id}', 'updateCustomer')->middleware('auth');
//     Route::post('form/customer/update', 'updateRecord')->middleware('auth')->name('form/customer/update');
//     Route::post('form/customer/delete', 'deleteRecord')->middleware('auth')->name('form/customer/delete');
// });

// ----------------------------- rooms -----------------------------//
// Route::controller(RoomsController::class)->group(function () {
//     Route::get('form/allrooms/page', 'allrooms')->middleware('auth')->name('form/allrooms/page');
//     Route::get('form/addroom/page', 'addRoom')->middleware('auth')->name('form/addroom/page');
//     Route::get('form/room/edit/{bkg_room_id}', 'editRoom')->middleware('auth');
//     Route::post('form/room/save', 'saveRecordRoom')->middleware('auth')->name('form/room/save');
//     Route::post('form/room/delete', 'deleteRecord')->middleware('auth')->name('form/room/delete');
//     Route::post('form/room/update', 'updateRecord')->middleware('auth')->name('form/room/update');
// });

// ----------------------- User Management -------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('users/list/page', 'userList')->middleware('auth')->name('users/list/page');
    Route::get('users/add/new', 'userAddNew')->middleware('auth')->name('users/add/new'); /** add new users */
    Route::get('users/add/edit/{user_id}', 'userView'); /** add new users */
    Route::post('users/update', 'userUpdate')->name('users/update'); /** update record */
    Route::get('users/edit/{id}', [UserManagementController::class, 'edit'])->name('usermanagement.edit');
    Route::post('users/update', [UserManagementController::class, 'update'])->name('usermanagement.update');
    Route::get('users/delete/{id}', 'userDelete')->name('users/delete'); /** delere record */
    Route::get('get-users-data', 'getUsersData')->name('get-users-data'); /** get all data users */
});

// ----------------------------- employee -----------------------------//
// Route::controller(EmployeeController::class)->group(function () {
//     Route::get('form/emplyee/list', 'employeesList')->middleware('auth')->name('form/emplyee/list');
//     Route::get('form/employee/add', 'employeesAdd')->middleware('auth')->name('form/employee/add');
//     Route::get('form/leaves/page', 'leavesPage')->middleware('auth')->name('form/leaves/page');
// });

// ----------------------------- Mata Uang -----------------------------//
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
Route::get('/pelanggan/edit/{id}', PelangganForm::class)->name('pelanggan/edit');
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


// ----------------------------- Proyek -----------------------------//
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


// ----------------------------- Pegawai -----------------------------//
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

// ----------------------------- Barang (duplicate) -----------------------------//
// Route::controller(BarangController::class)->group(function () {
//     Route::get('barang/list/page', 'daftarBarang')->middleware('auth')->name('barang/list/page');
//     Route::get('barang/add/new', 'tambahBarang')->middleware('auth')->name('barang/add/new');
//     Route::post('form/barang/save', 'simpanBarang')->middleware('auth')->name('form/barang/save');
//     Route::get('/barang/edit/{id}', [BarangController::class, 'editBarang'])->name('barang/edit');
//     Route::post('/barang/update/{id}', [BarangController::class, 'updateBarang'])->name('barang/update');
//     Route::post('/barang/delete', [BarangController::class, 'hapusBarang'])->name('barang/delete');
//     Route::get('get-barang-data', [BarangController::class, 'dataBarang'])->name('get-barang-data');
// });


// ----------------------------- Cluster -----------------------------//
Route::controller(ClusterController::class)->group(function () {
    Route::get('cluster/list/page', 'daftarCluster')->middleware('auth')->name('cluster/list/page');
    Route::get('cluster/add/new', 'tambahCluster')->middleware('auth')->name('cluster/add/new');
    Route::post('form/cluster/save', 'simpanCluster')->middleware('auth')->name('form/cluster/save');
    Route::get('/cluster/edit/{id}', [ClusterController::class, 'editCluster'])->name('cluster/edit');
    Route::post('/cluster/update/{id}', [ClusterController::class, 'updateCluster'])->name('cluster/update');
    Route::post('/cluster/delete', [ClusterController::class, 'hapusCluster'])->name('cluster/delete');
    Route::get('get-cluster-data', [ClusterController::class, 'dataCluster'])->name('get-cluster-data');
});


// ----------------------------- Konsumen -----------------------------//
Route::controller(KonsumenController::class)->group(function () {
    Route::get('konsumen/list/page', 'daftarKonsumen')->middleware('auth')->name('konsumen/list/page');
    Route::get('konsumen/add/new', 'tambahKonsumen')->middleware('auth')->name('konsumen/add/new');
    Route::post('form/konsumen/save', 'simpanKonsumen')->middleware('auth')->name('form/konsumen/save');
    Route::get('/konsumen/edit/{id}', [KonsumenController::class, 'editKonsumen'])->name('konsumen/edit');
    Route::post('/konsumen/update/{id}', [KonsumenController::class, 'updateKonsumen'])->name('konsumen/update');
    Route::post('/konsumen/delete', [KonsumenController::class, 'hapusKonsumen'])->name('konsumen/delete');
    Route::get('get-konsumen-data', [KonsumenController::class, 'dataKonsumen'])->name('get-konsumen-data');
});


// ----------------------------- Proyek Umum -----------------------------//
Route::controller(ProyekUmumController::class)->group(function () {
    Route::get('proyekumum/list/page', 'daftarProyekUmum')->middleware('auth')->name('proyekumum/list/page');
    Route::get('proyekumum/add/new', 'tambahProyekUmum')->middleware('auth')->name('proyekumum/add/new');
    Route::post('form/proyekumum/save', 'simpanProyekUmum')->middleware('auth')->name('form/proyekumum/save');
    Route::get('/proyekumum/edit/{id}', [ProyekUmumController::class, 'editProyekUmum'])->name('proyekumum/edit');
    Route::post('/proyekumum/update/{id}', [ProyekUmumController::class, 'updateProyekUmum'])->name('proyekumum/update');
    Route::post('/proyekumum/delete', [ProyekUmumController::class, 'hapusProyekUmum'])->name('proyekumum/delete');
    Route::get('get-proyekumum-data', [ProyekUmumController::class, 'dataProyekUmum'])->name('get-proyekumum-data');
});


// ----------------------------- Penyesuaian Barang -----------------------------//
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


// ----------------------------- Pindah Barang -----------------------------//
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


// ----------------------------- Permintaan Pembelian -----------------------------//
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

Route::get('get-permintaan2-data', [PermintaanPembelianController::class, 'tambahPermintaan'])->name('get-permintaan2-data');


// ----------------------------- Pesanan Pembelian -----------------------------//
Route::controller(PesananPembelianController::class)->group(function () {
    Route::get('pembelian/pesanan/list/page', 'daftarPesanan')->middleware('auth')->name('pembelian/pesanan/list/page');
    Route::get('pembelian/pesanan/add/new/', 'tambahPesanan')->middleware('auth')->name('pembelian/pesanan/add/new');
    Route::post('form/pembelian/pesanan/save', 'simpanPesanan')->middleware('auth')->name('form/pembelian/pesanan/save');
    Route::get('/pembelian/pesanan/edit/{id}/{no_permintaan}', 'editPesanan')->middleware('auth')->name('pembelian/pesanan/edit');
    Route::post('/pembelian/pesanan/update/{id}', 'updatePesanan')->middleware('auth')->name('pembelian/pesanan/update');
    Route::post('/pembelian/pesanan/delete', 'hapusPesanan')->middleware('auth')->name('pembelian/pesanan/delete');
    Route::get('get-pesanan-data', 'dataPesanan')->name('get-pesanan-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});

Route::get('get-pesanan2-data', [PesananPembelianController::class, 'tambahPesanan'])->name('get-pesanan2-data');

Route::get('get-pesanan23-data', [PesananPembelianController::class, 'tambahPesanan'])->name('get-pesanan23-data');

Route::get('/get-detail-permintaan', [PesananPembelianController::class, 'getDetailPermintaan']);


// ----------------------------- Penerimaan Pembelian -----------------------------//
Route::controller(PenerimaanPembelianController::class)->group(function () {
    Route::get('pembelian/penerimaan/list/page', 'daftarPenerimaan')->middleware('auth')->name('pembelian/penerimaan/list/page');
    Route::get('pembelian/penerimaan/add/new/', 'tambahPenerimaan')->middleware('auth')->name('pembelian/penerimaan/add/new');
    Route::post('form/pembelian/penerimaan/save', 'simpanPenerimaan')->middleware('auth')->name('form/pembelian/penerimaan/save');
    Route::get('/pembelian/penerimaan/edit/{id}/{no_permintaan}', 'editPenerimaan')->middleware('auth')->name('pembelian/penerimaan/edit');
    Route::post('/pembelian/penerimaan/update/{id}', 'updatePenerimaan')->middleware('auth')->name('pembelian/penerimaan/update');
    Route::post('/pembelian/penerimaan/delete', 'hapusPenerimaan')->middleware('auth')->name('pembelian/penerimaan/delete');
    Route::get('get-penerimaan-data', 'dataPenerimaan')->name('get-penerimaan-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});

Route::get('get-penerimaan2-data', [PenerimaanPembelianController::class, 'tambahPenerimaan'])->name('get-penerimaan2-data');

Route::get('get-penerimaan23-data', [PenerimaanPembelianController::class, 'tambahPenerimaan'])->name('get-penerimaan23-data');

Route::get('/get-detail-penerimaan', [PenerimaanPembelianController::class, 'getDetailPenerimaan']);


// ----------------------------- Faktur Pembelian -----------------------------//
Route::controller(FakturPembelianController::class)->group(function () {
    Route::get('pembelian/faktur/list/page', 'daftarFaktur')->middleware('auth')->name('pembelian/faktur/list/page');
    Route::get('pembelian/faktur/add/new/', 'tambahFaktur')->middleware('auth')->name('pembelian/faktur/add/new');
    Route::post('form/pembelian/faktur/save', 'simpanFaktur')->middleware('auth')->name('form/pembelian/faktur/save');
    Route::get('/pembelian/faktur/edit/{id}/{no_permintaan}', 'editFaktur')->middleware('auth')->name('pembelian/faktur/edit');
    Route::post('/pembelian/faktur/update/{id}', 'updateFaktur')->middleware('auth')->name('pembelian/faktur/update');
    Route::post('/pembelian/faktur/delete', 'hapusFaktur')->middleware('auth')->name('pembelian/faktur/delete');
    Route::get('get-faktur-data', 'dataFaktur')->name('get-faktur-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});

Route::get('get-faktur2-data', [FakturPembelianController::class, 'tambahFaktur'])->name('get-faktur2-data');

Route::get('get-faktur23-data', [FakturPembelianController::class, 'tambahFaktur'])->name('get-faktur23-data');

Route::get('/get-detail-faktur', [FakturPembelianController::class, 'getDetailFaktur']);

Route::get('/get-detail2-faktur', [FakturPembelianController::class, 'getDetailPenerimaan2']);


// ----------------------------- Cabang -----------------------------//
Route::controller(CabangController::class)->group(function () {
    Route::get('cabang/list/page', 'cabangList')->middleware('auth')->name('cabang/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('cabang/add/new', 'CabangAddNew')->middleware('auth')->name('cabang/add/new');
    Route::post('form/cabang/save', 'saveRecordCabang')->middleware('auth')->name('form/cabang/save');
    Route::get('/cabang/edit/{id}', [CabangController::class, 'edit'])->name('cabang/edit');
    Route::post('/cabang/update/{id}', [CabangController::class, 'update'])->name('cabang/update');
    Route::post('/cabang/delete', [CabangController::class, 'delete'])->name('cabang/delete');
    Route::get('get-cabang-data', [CabangController::class, 'getCabang'])->name('get-cabang-data');
});


// ----------------------------- Pembayaran Pembelian -----------------------------//
Route::controller(PembayaranPembelianController::class)->group(function () {
    Route::get('pembelian/pembayaran/list/page', 'daftarPembayaran')->middleware('auth')->name('pembelian/pembayaran/list/page');
    Route::get('pembelian/pembayaran/add/new/', 'tambahPembayaran')->middleware('auth')->name('pembelian/pembayaran/add/new');
    Route::post('form/pembelian/pembayaran/save', 'simpanPembayaran')->middleware('auth')->name('form/pembelian/pembayaran/save');
    Route::get('/pembelian/pembayaran/edit/{id}/{no_permintaan}', 'editPembayaran')->middleware('auth')->name('pembelian/pembayaran/edit');
    Route::post('/pembelian/pembayaran/update/{id}', 'updatePembayaran')->middleware('auth')->name('pembelian/pembayaran/update');
    Route::post('/pembelian/pembayaran/delete', 'hapusPembayaran')->middleware('auth')->name('pembelian/pembayaran/delete');
    Route::get('get-pembayaran-data', 'dataPembayaran')->name('get-pembayaran-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});

Route::get('get-pembayaran2-data', [PembayaranPembelianController::class, 'tambahPembayaran'])->name('get-pembayaran2-data');

Route::get('get-pembayaran23-data', [PembayaranPembelianController::class, 'tambahPembayaran'])->name('get-pembayaran23-data');

Route::get('/get-detail-pembayaran', [PembayaranPembelianController::class, 'getDetailPembayaran']);


// ----------------------------- Retur Pembelian -----------------------------//
Route::controller(ReturPembelianController::class)->group(function () {
    Route::get('pembelian/retur/list/page', 'daftarRetur')->middleware('auth')->name('pembelian/retur/list/page');
    Route::get('pembelian/retur/add/new/', 'tambahRetur')->middleware('auth')->name('pembelian/retur/add/new');
    Route::post('form/pembelian/retur/save', 'simpanRetur')->middleware('auth')->name('form/pembelian/retur/save');
    Route::get('/pembelian/retur/edit/{id}/{no_permintaan}', 'editRetur')->middleware('auth')->name('pembelian/retur/edit');
    Route::post('/pembelian/retur/update/{id}', 'updateRetur')->middleware('auth')->name('pembelian/retur/update');
    Route::post('/pembelian/retur/delete', 'hapusRetur')->middleware('auth')->name('pembelian/retur/delete');
    Route::get('get-retur-data', 'dataRetur')->name('get-retur-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});

Route::get('get-retur2-data', [ReturPembelianController::class, 'tambahRetur'])->name('get-retur2-data');

Route::get('get-retur23-data', [ReturPembelianController::class, 'tambahRetur'])->name('get-retur23-data');

Route::get('/get-detail-retur', [ReturPembelianController::class, 'getDetailRetur']);

Route::get('/get-detail2-retur', [ReturPembelianController::class, 'getDetailRetur2']);


// ----------------------------- Aktiva - (INTERNSHIP TEAM) ----------------------------//
Route::controller(AktivaTetapController::class)->group(function () {
    Route::get('aktivatetap/list/page', 'AktivaTetapList')->middleware('auth')->name('aktivatetap/list/page');
    Route::get('aktivatetap/add/new', 'AktivaTetapAddNew')->middleware('auth')->name('aktivatetap/add/new');
    Route::post('form/aktivatetap/save', 'saveRecordAktivaTetap')->middleware('auth')->name('form/aktivatetap/save');
    Route::get('/aktivatetap/edit/{id}', [AktivaTetapController::class, 'edit'])->name('aktivatetap/edit');
    Route::post('/aktivatetap/update/{id}', [AktivaTetapController::class, 'update'])->name('aktivatetap/update');
    Route::post('/aktivatetap/delete', [AktivaTetapController::class, 'delete'])->name('aktivatetap/delete');
    Route::get('get-aktivatetap-data', [AktivaTetapController::class, 'getAktivaTetap'])->name('get-aktivatetap-data');
});

Route::controller(TipeAktivaTetapPajakController::class)->group(function () {
    Route::get('tipeaktivatetappajak/list/page', 'TipeAktivaTetapPajakList')->middleware('auth')->name('tipeaktivatetappajak/list/page');
    Route::get('tipeaktivatetappajak/add/new', 'TipeAktivaTetapPajakAddNew')->middleware('auth')->name('tipeaktivatetappajak/add/new');
    Route::post('form/tipeaktivatetappajak/save', 'saveRecordTipeAktivaTetapPajak')->middleware('auth')->name('form/tipeaktivatetappajak/save');
    Route::get('/tipeaktivatetappajak/edit/{id}', [TipeAktivaTetapPajakController::class, 'edit'])->name('tipeaktivatetappajak/edit');
    Route::post('/tipeaktivatetappajak/update/{id}', [TipeAktivaTetapPajakController::class, 'update'])->name('tipeaktivatetappajak/update');
    Route::post('/tipeaktivatetappajak/delete', [TipeAktivaTetapPajakController::class, 'delete'])->name('tipeaktivatetappajak/delete');
    Route::get('get-tipeaktivatetappajak-data', [TipeAktivaTetapPajakController::class, 'getTipeAktivaTetapPajak'])->name('get-tipeaktivatetappajak-data');
});

Route::controller(TipeAktivaTetapController::class)->group(function () {
    Route::get('tipeaktivatetap/list/page', 'TipeAktivaTetapList')->middleware('auth')->name('tipeaktivatetap/list/page');
    Route::get('tipeaktivatetap/add/new', 'TipeAktivaTetapAddNew')->middleware('auth')->name('tipeaktivatetap/add/new');
    Route::post('form/tipeaktivatetap/save', 'saveRecordTipeAktivaTetap')->middleware('auth')->name('form/tipeaktivatetap/save');
    Route::get('/tipeaktivatetap/edit/{id}', [TipeAktivaTetapController::class, 'edit'])->name('tipeaktivatetap/edit');
    Route::post('/tipeaktivatetap/update/{id}', [TipeAktivaTetapController::class, 'update'])->name('tipeaktivatetap/update');
    Route::post('/tipeaktivatetap/delete', [TipeAktivaTetapController::class, 'delete'])->name('tipeaktivatetap/delete');
    Route::get('get-tipeaktivatetap-data', [TipeAktivaTetapController::class, 'getTipeAktivaTetap'])->name('get-tipeaktivatetap-data');
});

Route::controller(HargaJualController::class)->group(function () {
    Route::get('hargajual/list/page', 'HargaJualList')->middleware('auth')->name('hargajual/list/page');
    Route::get('hargajual/add/new', 'HargaJualAddNew')->middleware('auth')->name('hargajual/add/new');
    Route::post('form/tipeaktivatetap/save', 'saveRecordTipeAktivaTetap')->middleware('auth')->name('form/tipeaktivatetap/save');
    Route::get('/tipeaktivatetap/edit/{id}', [TipeAktivaTetapController::class, 'edit'])->name('tipeaktivatetap/edit');
    Route::post('/tipeaktivatetap/update/{id}', [TipeAktivaTetapController::class, 'update'])->name('tipeaktivatetap/update');
    Route::post('/tipeaktivatetap/delete', [TipeAktivaTetapController::class, 'delete'])->name('tipeaktivatetap/delete');
    Route::get('get-tipeaktivatetap-data', [TipeAktivaTetapController::class, 'getTipeAktivaTetap'])->name('get-tipeaktivatetap-data');
});

Route::controller(PenyusutanController::class)->group(function () {
    Route::get('penyusutan/list/page', 'PenyusutanList')->middleware('auth')->name('penyusutan/list/page');
    Route::get('penyusutan/add/new', 'PenyusutanAddNew')->middleware('auth')->name('penyusutan/add/new');
    Route::post('form/penyusutan/save', 'saveRecordPenyusutan')->middleware('auth')->name('form/penyusutan/save');
    Route::get('/penyusutan/edit/{id}', [PenyusutanController::class, 'edit'])->name('penyusutan/edit');
    Route::post('/penyusutan/update/{id}', [PenyusutanController::class, 'update'])->name('penyusutan/update');
    Route::post('/penyusutan/delete', [PenyusutanController::class, 'delete'])->name('penyusutan/delete');
    Route::get('get-penyusutan-data', [PenyusutanController::class, 'getPenyusutan'])->name('get-penyusutan-data');
});

Route::controller(BarangPerGudangController::class)->group(function () {
    Route::get('barangpergudang/list/page', 'BarangPerGudangList')->middleware('auth')->name('barangpergudang/list/page');
    Route::get('/barang-per-gudang/list', [BarangPerGudangController::class, 'getBarangPerGudangData'])->name('get-barang-per-gudang');
});

Route::controller(PembiayaanPesananController::class)->group(function () {
    Route::get('pembiayaanpesanan/list/page', 'PembiayaanPesananList')->middleware('auth')->name('pembiayaanpesanan/list/page');
    Route::get('pembiayaanpesanan/add/new', 'PembiayaanPesananAddNew')->middleware('auth')->name('pembiayaanpesanan/add/new');
    Route::post('form/pembiayaanpesanan/save', 'saveRecordPembiayaanPesanan')->middleware('auth')->name('form/pembiayaanpesanan/save');
    Route::get('/pembiayaanpesanan/edit/{id}', [PembiayaanPesananController::class, 'edit'])->name('pembiayaanpesanan/edit');
    Route::post('/pembiayaanpesanan/update/{id}', [PembiayaanPesananController::class, 'update'])->name('pembiayaanpesanan/update');
    Route::post('/pembiayaanpesanan/delete', [PembiayaanPesananController::class, 'delete'])->name('pembiayaanpesanan/delete');
    Route::get('get-pembiayaanpesanan-data', [PembiayaanPesananController::class, 'getpembiayaanpesanan'])->name('get-pembiayaanpesanan-data');
});


Route::controller(PencatatanNomorSerialController::class)->group(function () {
    Route::get('pencatatannomorserial/list/page', 'PencatatanNomorSerialList')->middleware('auth')->name('pencatatannomorserial/list/page');
    Route::get('pencatatannomorserial/add/new', 'PencatatanNomorSerialAddNew')->middleware('auth')->name('pencatatannomorserial/add/new');
    Route::post('form/pencatatannomorserial/save', 'saveRecordPencatatanNomorSerial')->middleware('auth')->name('form/pencatatannomorserial/save');
    Route::get('/pencatatannomorserial/edit/{id}', [PencatatanNomorSerialController::class, 'edit'])->name('pencatatannomorserial/edit');
    Route::post('/pencatatannomorserial/update/{id}', [PencatatanNomorSerialController::class, 'update'])->name('pencatatannomorserial/update');
    Route::post('/pencatatannomorserial/delete', [PencatatanNomorSerialController::class, 'delete'])->name('pencatatannomorserial/delete');
    Route::get('get-pencatatan-nomor-serial-data', [PencatatanNomorSerialController::class, 'getPencatatanNomorSerial'])->name('get-pencatatan-nomor-serial-data');
});

// ----------------------------- Marketing - (INTERNSHIP TEAM) ----------------------------//

Route::controller(ProspekController::class)->group(function () {
    Route::get('prospek/list/page', 'ProspekList')->middleware('auth')->name('prospek/list/page');
    Route::get('prospek/add/new', 'ProspekAddNew')->middleware('auth')->name('prospek/add/new');
    Route::post('form/prospek/save', 'saveRecordProspek')->middleware('auth')->name('form/prospek/save');
    Route::get('/prospek/edit/{id}', [ProspekController::class, 'edit'])->name('prospek/edit');
    Route::post('/prospek/update/{id}', [ProspekController::class, 'update'])->name('prospek/update');
    Route::post('/prospek/delete', [ProspekController::class, 'delete'])->name('prospek/delete');
    Route::get('get-prospek-data', [ProspekController::class, 'getProspek'])->name('get-prospek-data');
});

Route::controller(KonsumenMarketingController::class)->group(function () {
    Route::get('konsumenmarketing/list/page', 'KonsumenMarketingList')->middleware('auth')->name('konsumenmarketing/list/page');
    Route::get('konsumenmarketing/add/new', 'KonsumenMarketingAddNew')->middleware('auth')->name('konsumenmarketing/add/new');
    Route::post('form/konsumenmarketing/save', 'saveRecordKonsumenMarketing')->middleware('auth')->name('form/konsumenmarketing/save');
    Route::get('/konsumenmarketing/edit/{id}', [KonsumenMarketingController::class, 'edit'])->name('konsumenmarketing/edit');
    Route::post('/konsumenmarketing/update/{id}', [KonsumenMarketingController::class, 'update'])->name('konsumenmarketing/update');
    Route::post('/konsumenmarketing/delete', [KonsumenMarketingController::class, 'delete'])->name('konsumenmarketing/delete');
    Route::get('get-konsumen-marketing-data', [KonsumenMarketingController::class, 'getKonsumenMarketing'])->name('get-konsumen-marketing-data');
});

// ----------------------------- Marketing sub-perumahan - (INTERNSHIP TEAM) ----------------------------//
Route::controller(SitePlanController::class)->group(function () {
    Route::get('siteplane/page', 'SitePlanView')->middleware('auth')->name('siteplane/page');
});

Route::controller(KlusterPerumahanController::class)->group(function () {
    Route::get('klusterperumahan/list/page', 'KlusterPerumahanList')->middleware('auth')->name('klusterperumahan/list/page');
    Route::get('klusterperumahan/add/new', 'KlusterPerumahanAddNew')->middleware('auth')->name('klusterperumahan/add/new');
    Route::post('form/klusterperumahan/save', 'saveRecordKlusterPerumahan')->middleware('auth')->name('form/klusterperumahan/save');
    Route::get('/klusterperumahan/edit/{id}', [KlusterPerumahanController::class, 'edit'])->name('klusterperumahan/edit');
    Route::post('/klusterperumahan/update/{id}', [KlusterPerumahanController::class, 'update'])->name('klusterperumahan/update');
    Route::post('/klusterperumahan/delete', [KlusterPerumahanController::class, 'delete'])->name('klusterperumahan/delete');
    Route::get('get-konsumen-marketing-data', [KlusterPerumahanController::class, 'getKlusterPerumahan'])->name('get-konsumen-marketing-data');
});

Route::controller(KavlingController::class)->group(function () {
    Route::get('kavling/list/page', 'KavlingList')->middleware('auth')->name('kavling/list/page');
    Route::get('kavling/add/new', 'KavlingAddNew')->middleware('auth')->name('kavling/add/new');
    Route::post('form/kavling/save', 'saveRecordKavling')->middleware('auth')->name('form/kavling/save');
    Route::get('kavling/edit/{id}', 'edit')->middleware('auth')->name('kavling/edit');
    Route::post('kavling/update/{id}', 'update')->middleware('auth')->name('kavling/update');
    Route::post('kavling/delete', 'delete')->middleware('auth')->name('kavling/delete');
    Route::get('get-kavling-data', 'getKavling')->middleware('auth')->name('get/kavling/data');
});

Route::controller(FasumController::class)->group(function () {
    Route::get('fasum/list/page', 'FasumList')->middleware('auth')->name('fasum/list/page');
    Route::get('fasum/add/new', 'FasumAddNew')->middleware('auth')->name('fasum/add/new');
    Route::post('form/fasum/save', 'saveRecordFasum')->middleware('auth')->name('form/fasum/save');
    Route::get('fasum/edit/{id}', 'edit')->middleware('auth')->name('fasum/edit');
    Route::post('fasum/update/{id}', 'update')->middleware('auth')->name('fasum/update');
    Route::post('fasum/delete', 'delete')->middleware('auth')->name('fasum/delete');
    Route::get('get-fasum-data', 'getFasum')->middleware('auth')->name('get/fasum/data');
});

Route::controller(FasosController::class)->group(function () {
    Route::get('fasos/list/page', 'FasosList')->middleware('auth')->name('fasos/list/page');
    Route::get('fasos/add/new', 'FasosAddNew')->middleware('auth')->name('fasos/add/new');
    Route::post('form/fasos/save', 'saveRecordFasos')->middleware('auth')->name('form/fasos/save');
    Route::get('fasos/edit/{id}', 'edit')->middleware('auth')->name('fasos/edit');
    Route::post('fasos/update/{id}', 'update')->middleware('auth')->name('fasos/update');
    Route::post('fasos/delete', 'delete')->middleware('auth')->name('fasos/delete');
    Route::get('get-fasos-data', 'getFasos')->middleware('auth')->name('get/fasos/data');
});

// ----------------------------- Marketing sub-TiketCostumer - (INTERNSHIP TEAM) ----------------------------//

Route::controller(KategoriTiketKostumerController::class)->group(function () {
    Route::get('kategoritiketkostumer/list/page', 'KategoriTiketKostumerList')->middleware('auth')->name('kategoritiketkostumer/list/page');
    Route::get('kategoritiketkostumer/add/new', 'KategoriTiketKostumerAddNew')->middleware('auth')->name('kategoritiketkostumer/add/new');
    Route::post('form/kategoritiketkostumer/save', 'saveRecordKategoriTiketKostumer')->middleware('auth')->name('form/kategoritiketkostumer/save');
    Route::get('/kategoritiketkostumer/edit/{id}', [KategoriTiketKostumerController::class, 'edit'])->name('kategoritiketkostumer/edit');
    Route::post('/kategoritiketkostumer/update/{id}', [KategoriTiketKostumerController::class, 'update'])->name('kategoritiketkostumer/update');
    Route::post('/kategoritiketkostumer/delete', [KategoriTiketKostumerController::class, 'delete'])->name('kategoritiketkostumer/delete');
    Route::get('get-kategori-tiket-kostumer-data', [KategoriTiketKostumerController::class, 'getKategoriTiketKostumer'])->name('get-kategori-tiket-kostumer-data');
});

Route::controller(TiketKostumerController::class)->group(function () {
    Route::get('tiketkostumer/list/page', 'TiketKostumerList')->middleware('auth')->name('tiketkostumer/list/page');
});

Route::controller(DataBookingController::class)->group(function () {
    Route::get('databooking/list/page', 'DataBookingList')->middleware('auth')->name('databooking/list/page');
});

Route::controller(SuratPerintahPembangunanController::class)->group(function () {
    Route::get('suratperintahpembangunan/list/page', 'SuratPerintahPembangunanList')->middleware('auth')->name('suratperintahpembangunan/list/page');
    Route::get('suratperintahpembangunan/add/new', 'SuratPerintahPembangunanAddNew')->middleware('auth')->name('suratperintahpembangunan/add/new');
    Route::post('form/suratperintahpembangunan/save', 'saveRecordSuratPerintahPembangunan')->middleware('auth')->name('form/suratperintahpembangunan/save');
    Route::get('suratperintahpembangunan/edit/{id}', [SuratPerintahPembangunanController::class, 'edit'])->name('suratperintahpembangunan/edit');
    Route::post('suratperintahpembangunan/update/{id}', [SuratPerintahPembangunanController::class, 'update'])->name('suratperintahpembangunan/update');
    Route::post('suratperintahpembangunan/delete', [SuratPerintahPembangunanController::class, 'delete'])->name('suratperintahpembangunan/delete');
    Route::get('get-surat-perintah-pembangunan-data', [SuratPerintahPembangunanController::class, 'getSuratPerintahPembangunan'])->name('get-surat-perintah-pembangunan-data');
});



