<?php

use App\Models\Room;
require __DIR__.'/penjualan.php';
require __DIR__.'/laporan.php';
require __DIR__.'/buku_besar.php';
use App\Models\PindahBarang;
use App\Livewire\ProspekForm;
use App\Livewire\KonsumenForm;
use App\Models\TipeAktivaTetapPajak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\KlusterPerumahanForm;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Home2Controller;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SyaratController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\MataUangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\ProyekUmumController;
use App\Http\Controllers\PindahBarangController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StatusPemasokController;
use App\Http\Controllers\TipePelangganController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\ReturPembelianController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\FakturPembelianController;
use App\Http\Controllers\PesananPembelianController;
use App\Http\Controllers\Aktiva\PenyusutanController;
use App\Http\Controllers\Marketing\ProspekController;
use App\Http\Controllers\PenyesuaianBarangController;
use App\Http\Controllers\Aktiva\AktivaTetapController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PembayaranPembelianController;
use App\Http\Controllers\PenerimaanPembelianController;
use App\Http\Controllers\PermintaanPembelianController;
use App\Http\Controllers\Marketing\Perumahan\KlusterPerumahanController;
use App\Http\Controllers\Persediaan\HargaJualController;
use App\Http\Controllers\Marketing\DataBookingController;
use App\Http\Controllers\Aktiva\TipeAktivaTetapController;
use App\Http\Controllers\Marketing\Perumahan\FasosController;
use App\Http\Controllers\Marketing\Perumahan\FasumController;
use App\Http\Controllers\Persediaan\BarangPerGudangController;
use App\Http\Controllers\Aktiva\TipeAktivaTetapPajakController;
use App\Http\Controllers\Marketing\KonsumenMarketingController;
use App\Http\Controllers\Marketing\Perumahan\KavlingController;
use App\Http\Controllers\Marketing\Perumahan\SitePlanController;
use App\Http\Controllers\Persediaan\PembiayaanPesananController;
use App\Http\Controllers\Persediaan\PencatatanNomorSerialController;
use App\Http\Controllers\Projek\KemajuanPembangunanController;
use App\Http\Controllers\Projek\Lahan\DataLahanController;
use App\Http\Controllers\Projek\Lahan\MasterBiayaLahanController;
use App\Http\Controllers\Projek\PengajuanBahanBangunanController;
use App\Http\Controllers\Projek\PengajuanBahanLainyaController;
use App\Http\Controllers\Projek\PerencanaanPembangunanController;
use App\Http\Controllers\Projek\RabrapController;
use App\Http\Controllers\Projek\SpkMandorPekerjaController;
use App\Http\Controllers\Projek\PekerjaController;
use App\Http\Controllers\Marketing\SuratPerintahPembangunanController;
use App\Http\Controllers\Marketing\TiketKostumer\KategoriTiketKostumerController;
use App\Http\Controllers\Marketing\TiketKostumer\TiketKostumerController;



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
Route::controller(MataUangController::class)->group(function () {
    Route::get('matauang/list/page', 'matauangList')->middleware('auth')->name('matauang/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('matauang/add/new', 'MataUangAddNew')->middleware('auth')->name('matauang/add/new');
    Route::post('form/matauang/save', 'saveRecordMataUang')->middleware('auth')->name('form/matauang/save');
    Route::get('/matauang/edit/{id}', [MataUangController::class, 'edit'])->name('matauang.edit');
    Route::post('/matauang/update/{id}', [MataUangController::class, 'update'])->name('matauang.update');
    Route::post('/matauang/delete', [MataUangController::class, 'delete'])->name('matauang.delete');
    Route::get('get-matauang-data', [MataUangController::class, 'getMataUang'])->name('get-matauang-data');
});


// ----------------------------- Status Pemasok -----------------------------//
Route::controller(StatusPemasokController::class)->group(function () {
    Route::get('statuspemasok/list/page', 'statusPemasokList')->middleware('auth')->name('statuspemasok/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('statuspemasok/add/new', 'StatusPemasokAddNew')->middleware('auth')->name('statuspemasok/add/new');
    Route::post('form/statuspemasok/save', 'saveRecordStatusPemasok')->middleware('auth')->name('form/statuspemasok/save');
    Route::get('/statuspemasok/edit/{id}', [StatusPemasokController::class, 'edit'])->name('statuspemasok/edit');
    Route::post('/statuspemasok/update/{id}', [StatusPemasokController::class, 'update'])->name('statuspemasok/update');
    Route::post('/statuspemasok/delete', [StatusPemasokController::class, 'delete'])->name('statuspemasok/delete');
    Route::get('get-statuspemasok-data', [StatusPemasokController::class, 'getStatusPemasok'])->name('get-statuspemasok-data');
});


// ----------------------------- Pemasok -----------------------------//
Route::controller(PemasokController::class)->group(function () {
    Route::get('pemasok/list/page', 'PemasokList')->middleware('auth')->name('pemasok/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('pemasok/add/new', 'PemasokAddNew')->middleware('auth')->name('pemasok/add/new');
    Route::post('form/pemasok/save', 'saveRecordPemasok')->middleware('auth')->name('form/pemasok/save');
    Route::get('/pemasok/edit/{id}/{pemasok_id}', [PemasokController::class, 'edit'])->name('pemasok/edit');
    Route::post('/pemasok/update/{pemasok_id}', [PemasokController::class, 'update'])->name('pemasok/update');
    Route::post('/pemasok/delete', [PemasokController::class, 'delete'])->name('pemasok/delete');
    Route::get('get-pemasok-data', [PemasokController::class, 'getPemasok'])->name('get-pemasok-data');
    // Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
    // Route::get('cities', 'DependentDropdownController@cities')->name('cities');
});


// ----------------------------- Syarat Pembayaran -----------------------------//
Route::controller(SyaratController::class)->group(function () {
    Route::get('syarat/list/page', 'syaratList')->middleware('auth')->name('syarat/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('syarat/add/new', 'SyaratAddNew')->middleware('auth')->name('syarat/add/new');
    Route::post('form/syarat/save', 'saveRecordSyarat')->middleware('auth')->name('form/syarat/save');
    Route::get('/syarat/edit/{id}', [SyaratController::class, 'edit'])->name('syarat/edit');
    Route::post('/syarat/update/{id}', [SyaratController::class, 'update'])->name('syarat/update');
    Route::post('/syarat/delete', [SyaratController::class, 'delete'])->name('syarat/delete');
    Route::get('get-syarat-data', [SyaratController::class, 'getSyarat'])->name('get-syarat-data');
});


// ----------------------------- Pajak -----------------------------//
Route::controller(PajakController::class)->group(function () {
    Route::get('pajak/list/page', 'pajakList')->middleware('auth')->name('pajak/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('pajak/add/new', 'PajakAddNew')->middleware('auth')->name('pajak/add/new');
    Route::post('form/pajak/save', 'saveRecordPajak')->middleware('auth')->name('form/pajak/save');
    Route::get('/pajak/edit/{id}', [PajakController::class, 'edit'])->name('pajak/edit');
    Route::post('/pajak/update/{id}', [PajakController::class, 'update'])->name('pajak/update');
    Route::post('/pajak/delete', [PajakController::class, 'delete'])->name('pajak/delete');
    Route::get('get-pajak-data', [PajakController::class, 'getPajak'])->name('get-pajak-data');
});


// ----------------------------- Tipe Pelanggan -----------------------------//
Route::controller(TipePelangganController::class)->group(function () {
    Route::get('tipepelanggan/list/page', 'tipePelangganList')->middleware('auth')->name('tipepelanggan/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('tipepelanggan/add/new', 'TipePelangganAddNew')->middleware('auth')->name('tipepelanggan/add/new');
    Route::post('form/tipepelanggan/save', 'saveRecordTipePelanggan')->middleware('auth')->name('form/tipepelanggan/save');
    Route::get('/tipepelanggan/edit/{id}', [TipePelangganController::class, 'edit'])->name('tipepelanggan/edit');
    Route::post('/tipepelanggan/update/{id}', [TipePelangganController::class, 'update'])->name('tipepelanggan/update');
    Route::post('/tipepelanggan/delete', [TipePelangganController::class, 'delete'])->name('tipepelanggan/delete');
    Route::get('get-tipepelanggan-data', [TipePelangganController::class, 'getTipePelanggan'])->name('get-tipepelanggan-data');
});


// ----------------------------- Pelanggan -----------------------------//
Route::controller(PelangganController::class)->group(function () {
    Route::get('pelanggan/list/page', 'PelangganList')->middleware('auth')->name('pelanggan/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('pelanggan/add/new', 'PelangganAddNew')->middleware('auth')->name('pelanggan/add/new');
    Route::post('form/pelanggan/save', 'saveRecordPelanggan')->middleware('auth')->name('form/pelanggan/save');
    Route::get('/pelanggan/edit/{id}/{pelanggan_id}', [PelangganController::class, 'edit'])->name('pelanggan/edit');
    Route::post('/pelanggan/update/{pelanggan_id}', [PelangganController::class, 'update'])->name('pelanggan/update');
    Route::post('/pelanggan/delete', [PelangganController::class, 'delete'])->name('pelanggan/delete');
    Route::get('get-pelanggan-data', [PelangganController::class, 'getPelanggan'])->name('get-pelanggan-data');
    Route::get('/pelanggan/cari', [PelangganController::class, 'cari'])->name('/pelanggan/cari');
    Route::get('/ajax/indonesia/cities', [PelangganController::class, 'citiesByProvince'])->name('ajax.cities.by-province');
    Route::get('/ajax/indonesia/districts', [PelangganController::class, 'districtsByCity'])->name('ajax.districts.by-city');
    Route::get('/ajax/indonesia/villages', [PelangganController::class, 'villagesByDistrict'])->name('ajax.villages.by-district');
});

// ----------------------------- Tipe Pelanggan -----------------------------//
Route::controller(TipePelangganController::class)->group(function () {
    Route::get('tipepelanggan/list/page', 'tipePelangganList')->middleware('auth')->name('tipepelanggan/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('tipepelanggan/add/new', 'TipePelangganAddNew')->middleware('auth')->name('tipepelanggan/add/new');
    Route::post('form/tipepelanggan/save', 'saveRecordTipePelanggan')->middleware('auth')->name('form/tipepelanggan/save');
    Route::get('/tipepelanggan/edit/{id}', [TipePelangganController::class, 'edit'])->name('tipepelanggan/edit');
    Route::post('/tipepelanggan/update/{id}', [TipePelangganController::class, 'update'])->name('tipepelanggan/update');
    Route::post('/tipepelanggan/delete', [TipePelangganController::class, 'delete'])->name('tipepelanggan/delete');
    Route::get('get-tipepelanggan-data', [TipePelangganController::class, 'getTipePelanggan'])->name('get-tipepelanggan-data');
});


// ----------------------------- Penjual -----------------------------//
Route::controller(PenjualController::class)->group(function () {
    Route::get('penjual/list/page', 'penjualList')->middleware('auth')->name('penjual/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('penjual/add/new', 'PenjualAddNew')->middleware('auth')->name('penjual/add/new');
    Route::post('form/penjual/save', 'saveRecordPenjual')->middleware('auth')->name('form/penjual/save');
    Route::get('/penjual/edit/{id}', [PenjualController::class, 'edit'])->name('penjual/edit');
    Route::post('/penjual/update/{id}', [PenjualController::class, 'update'])->name('penjual/update');
    Route::post('/penjual/delete', [PenjualController::class, 'delete'])->name('penjual/delete');
    Route::get('get-penjual-data', [PenjualController::class, 'getPenjual'])->name('get-penjual-data');
});


// ----------------------------- Departemen -----------------------------//
Route::controller(DepartemenController::class)->group(function () {
    Route::get('departemen/list/page', 'DepartemenList')->middleware('auth')->name('departemen/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('departemen/add/new', 'DepartemenAddNew')->middleware('auth')->name('departemen/add/new');
    Route::post('form/departemen/save', 'saveRecordDepartemen')->middleware('auth')->name('form/departemen/save');
    Route::get('/departemen/edit/{id}/{departemen_id}', [DepartemenController::class, 'edit'])->name('departemen/edit');
    Route::post('/departemen/update/{departemen_id}', [DepartemenController::class, 'update'])->name('departemen/update');
    Route::post('/departemen/delete', [DepartemenController::class, 'delete'])->name('departemen/delete');
    Route::get('get-departemen-data', [DepartemenController::class, 'getDepartemen'])->name('get-departemen-data');
    // Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
    // Route::get('cities', 'DependentDropdownController@cities')->name('cities');
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
    Route::get('/ajax/indonesia/cities', [PegawaiController::class, 'citiesByProvince'])->name('ajax.cities.by-province');
    Route::get('/ajax/indonesia/districts', [PegawaiController::class, 'districtsByCity'])->name('ajax.districts.by-city');
    Route::get('/ajax/indonesia/villages', [PegawaiController::class, 'villagesByDistrict'])->name('ajax.villages.by-district');
});


// ----------------------------- Satuan -----------------------------//
Route::controller(SatuanController::class)->group(function () {
    Route::get('satuan/list/page', 'satuanList')->middleware('auth')->name('satuan/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('satuan/add/new', 'SatuanAddNew')->middleware('auth')->name('satuan/add/new');
    Route::post('form/satuan/save', 'saveRecordSatuan')->middleware('auth')->name('form/satuan/save');
    Route::get('/satuan/edit/{id}', [SatuanController::class, 'edit'])->name('satuan/edit');
    Route::post('/satuan/update/{id}', [SatuanController::class, 'update'])->name('satuan/update');
    Route::post('/satuan/delete', [SatuanController::class, 'delete'])->name('satuan/delete');
    Route::get('get-satuan-data', [SatuanController::class, 'getSatuan'])->name('get-satuan-data');
});


// ----------------------------- Gudang -----------------------------//
Route::controller(GudangController::class)->group(function () {
    Route::get('gudang/list/page', 'gudangList')->middleware('auth')->name('gudang/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('gudang/add/new', 'GudangAddNew')->middleware('auth')->name('gudang/add/new');
    Route::post('form/gudang/save', 'saveRecordGudang')->middleware('auth')->name('form/gudang/save');
    Route::get('/gudang/edit/{id}', [GudangController::class, 'edit'])->name('gudang/edit');
    Route::post('/gudang/update/{id}', [GudangController::class, 'update'])->name('gudang/update');
    Route::post('/gudang/delete', [GudangController::class, 'delete'])->name('gudang/delete');
    Route::get('get-gudang-data', [GudangController::class, 'getGudang'])->name('get-gudang-data');
});


// ----------------------------- Kategori Barang -----------------------------//
Route::controller(KategoriBarangController::class)->group(function () {
    Route::get('kategoribarang/list/page', 'kategoriBarangList')->middleware('auth')->name('kategoribarang/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('kategoribarang/add/new', 'KategoriBarangAddNew')->middleware('auth')->name('kategoribarang/add/new');
    Route::post('form/kategoribarang/save', 'saveRecordKategoriBarang')->middleware('auth')->name('form/kategoribarang/save');
    Route::get('/kategoribarang/edit/{id}', [KategoriBarangController::class, 'edit'])->name('kategoribarang/edit');
    Route::post('/kategoribarang/update/{id}', [KategoriBarangController::class, 'update'])->name('kategoribarang/update');
    Route::post('/kategoribarang/delete', [KategoriBarangController::class, 'delete'])->name('kategoribarang/delete');
    Route::get('get-kategoribarang-data', [KategoriBarangController::class, 'getKategoriBarang'])->name('get-kategoribarang-data');
});


// ----------------------------- Akun -----------------------------//
Route::controller(AkunController::class)->group(function () {
    Route::get('akun/list/page', 'akunList')->middleware('auth')->name('akun/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('akun/add/new', 'AkunAddNew')->middleware('auth')->name('akun/add/new');
    Route::post('form/akun/save', 'saveRecordAkun')->middleware('auth')->name('form/akun/save');
    Route::get('/akun/edit/{id}', [AkunController::class, 'edit'])->name('akun/edit');
    Route::post('/akun/update/{id}', [AkunController::class, 'update'])->name('akun/update');
    Route::post('/akun/delete', [AkunController::class, 'delete'])->name('akun/delete');
    Route::get('get-akun-data', [AkunController::class, 'getAkun'])->name('get-akun-data');
});


// ----------------------------- Barang -----------------------------//
Route::controller(BarangController::class)->group(function () {
    Route::get('barang/list/page', 'daftarBarang')->middleware('auth')->name('barang/list/page');
    Route::get('barang/add/new', 'tambahBarang')->middleware('auth')->name('barang/add/new');
    Route::post('form/barang/save', 'simpanBarang')->middleware('auth')->name('form/barang/save');
    Route::get('/barang/edit/{id}', [BarangController::class, 'editBarang'])->name('barang/edit');
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


// ----------------------------- Cluster (deprecated) -----------------------------//
Route::controller(ClusterController::class)->group(function () {
    Route::get('cluster/list/page', 'daftarCluster')->middleware('auth')->name('cluster/list/page');
    Route::get('cluster/add/new', 'tambahCluster')->middleware('auth')->name('cluster/add/new');
    Route::post('form/cluster/save', 'simpanCluster')->middleware('auth')->name('form/cluster/save');
    Route::get('/cluster/edit/{id}', [ClusterController::class, 'editCluster'])->name('cluster/edit');
    Route::post('/cluster/update/{id}', [ClusterController::class, 'updateCluster'])->name('cluster/update');
    Route::post('/cluster/delete', [ClusterController::class, 'hapusCluster'])->name('cluster/delete');
    Route::get('get-cluster-data', [ClusterController::class, 'dataCluster'])->name('get-cluster-data');
    Route::get('/ajax/indonesia/cities', [ClusterController::class, 'citiesByProvince'])->name('ajax.cities.by-province');
    Route::get('/ajax/indonesia/districts', [ClusterController::class, 'districtsByCity'])->name('ajax.districts.by-city');
    Route::get('/ajax/indonesia/villages', [ClusterController::class, 'villagesByDistrict'])->name('ajax.villages.by-district');
});

Route::controller(KonsumenController::class)->group(function () {
    Route::get('konsumen/list/page', 'daftarKonsumen')->middleware('auth')->name('konsumen/list/page');
    Route::get('konsumen/add/new', 'tambahKonsumen')->middleware('auth')->name('konsumen/add/new');
    Route::post('form/konsumen/save', 'simpanKonsumen')->middleware('auth')->name('form/konsumen/save');
    Route::get('/konsumen/edit/{id}', [KonsumenController::class, 'editKonsumen'])->name('konsumen/edit');
    Route::get('konsumen/detail/{id}', 'konsumenDetail')->middleware('auth')->name('konsumen/detail');
    Route::get('konsumen/detail/{id}/pdf', [KonsumenController::class, 'cetakKonsumen'])->name('konsumen/detail/pdf');
    Route::post('/konsumen/update/{id}', [KonsumenController::class, 'updateKonsumen'])->name('konsumen/update');
    Route::post('/konsumen/delete', [KonsumenController::class, 'hapusKonsumen'])->name('konsumen/delete');
    Route::get('get-konsumen-data', [KonsumenController::class, 'dataKonsumen'])->name('get-konsumen-data');
    Route::get('/ajax/indonesia/cities', [KonsumenController::class, 'citiesByProvince'])->name('ajax.cities.by-province');
    Route::get('/ajax/indonesia/districts', [KonsumenController::class, 'districtsByCity'])->name('ajax.districts.by-city');
    Route::get('/ajax/indonesia/villages', [KonsumenController::class, 'villagesByDistrict'])->name('ajax.villages.by-district');
    Route::get('/ajax/indonesia/cities_1', [KonsumenController::class, 'citiesByProvince_1'])->name('ajax.cities.by-province-1');
    Route::get('/ajax/indonesia/districts_1', [KonsumenController::class, 'districtsByCity_1'])->name('ajax.districts.by-city-1');
    Route::get('/ajax/indonesia/villages_1', [KonsumenController::class, 'villagesByDistrict_1'])->name('ajax.villages.by-district-1');
    Route::get('/ajax/indonesia/cities_2', [KonsumenController::class, 'citiesByProvince_2'])->name('ajax.cities.by-province-2');
    Route::get('/ajax/indonesia/districts_2', [KonsumenController::class, 'districtsByCity_2'])->name('ajax.districts.by-city-2');
    Route::get('/ajax/indonesia/villages_2', [KonsumenController::class, 'villagesByDistrict_2'])->name('ajax.villages.by-district-2');
    Route::get('/ajax/indonesia/cities_3', [KonsumenController::class, 'citiesByProvince_3'])->name('ajax.cities.by-province-3');
    Route::get('/ajax/indonesia/districts_3', [KonsumenController::class, 'districtsByCity_3'])->name('ajax.districts.by-city-3');
    Route::get('/ajax/indonesia/villages_3', [KonsumenController::class, 'villagesByDistrict_3'])->name('ajax.villages.by-district-3');
    Route::get('/ajax/indonesia/cities_4', [KonsumenController::class, 'citiesByProvince_4'])->name('ajax.cities.by-province-4');
    Route::get('/ajax/indonesia/districts_4', [KonsumenController::class, 'districtsByCity_4'])->name('ajax.districts.by-city-4');
    Route::get('/ajax/indonesia/villages_4', [KonsumenController::class, 'villagesByDistrict_4'])->name('ajax.villages.by-district-4');
    Route::get('/ajax/indonesia/cities_5', [KonsumenController::class, 'citiesByProvince_5'])->name('ajax.cities.by-province-5');
    Route::get('/ajax/indonesia/districts_5', [KonsumenController::class, 'districtsByCity_5'])->name('ajax.districts.by-city-5');
    Route::get('/ajax/indonesia/villages_5', [KonsumenController::class, 'villagesByDistrict_5'])->name('ajax.villages.by-district-5');
    Route::get('/ajax/indonesia/cities_6', [KonsumenController::class, 'citiesByProvince_6'])->name('ajax.cities.by-province-6');
    Route::get('/ajax/indonesia/districts_6', [KonsumenController::class, 'districtsByCity_6'])->name('ajax.districts.by-city-6');
    Route::get('/ajax/indonesia/villages_6', [KonsumenController::class, 'villagesByDistrict_6'])->name('ajax.villages.by-district-6');
    Route::get('/ajax/indonesia/cities_7', [KonsumenController::class, 'citiesByProvince_7'])->name('ajax.cities.by-province-7');
    Route::get('/ajax/indonesia/districts_7', [KonsumenController::class, 'districtsByCity_7'])->name('ajax.districts.by-city-7');
    Route::get('/ajax/indonesia/villages_7', [KonsumenController::class, 'villagesByDistrict_7'])->name('ajax.villages.by-district-7');
    
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

Route::get('get-detail-faktur', [FakturPembelianController::class, 'getDetailFaktur'])->name('get-detail-faktur');

Route::get('get-detail2-faktur', [FakturPembelianController::class, 'getDetailPenerimaan2'])->name('get-detail2-faktur');


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
    Route::get('get-akuns-data', [AktivaTetapController::class, 'tambahAktivaTetap'])->name('get-akuns-data');
    Route::get('/get-detail-akun', [AktivaTetapController::class, 'getDetailAktivaTetap']);
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
    // Route::post('form/tipeaktivatetap/save', 'saveRecordHargajual')->middleware('auth')->name('form/tipeaktivatetap/save');
    // Route::get('/tipeaktivatetap/edit/{id}', [HargaJualController::class, 'edit'])->name('tipeaktivatetap/edit');
    // Route::post('/tipeaktivatetap/update/{id}', [HargaJualController::class, 'update'])->name('tipeaktivatetap/update');
    // Route::post('/tipeaktivatetap/delete', [HargaJualController::class, 'delete'])->name('tipeaktivatetap/delete');
    // Route::get('get-tipeaktivatetap-data', [HargaJualController::class, 'getTipeAktivaTetap'])->name('get-tipeaktivatetap-data');
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

Route::get('prospek/add/new', ProspekForm::class)->middleware('auth')->name('prospek/add/new');
Route::get('/prospek/edit/{id}', ProspekForm::class)->name('prospek/edit');
    Route::controller(ProspekController::class)->group(function () {
    Route::get('prospek/list/page', 'ProspekList')->middleware('auth')->name('prospek/list/page');
    Route::post('/prospek/delete', 'delete')->name('prospek/delete');
    Route::get('get-prospek-data', 'getProspek')->name('get-prospek-data');
});

// ----------------------------- Konsumen (deprecated) -----------------------------//
// Route::get('konsumenmarketing/add/new', KonsumenForm::class)->middleware('auth')->name('konsumenmarketing/add/new');
// Route::get('/konsumenmarketing/edit/{id}', KonsumenForm::class)->name('konsumenmarketing/edit');
// Route::controller(KonsumenMarketingController::class)->group(function () {
//     Route::get('konsumenmarketing/list/page', 'KonsumenMarketingList')->middleware('auth')->name('konsumenmarketing/list/page');
//     Route::post('/konsumenmarketing/delete', [KonsumenMarketingController::class, 'delete'])->name('konsumenmarketing/delete');
//     Route::get('get-konsumen-data', [KonsumenMarketingController::class, 'getKonsumen'])->name('get-konsumen-data');
// });

// ----------------------------- Marketing sub-perumahan - (INTERNSHIP TEAM) ----------------------------//
Route::controller(SitePlanController::class)->group(function () {
    Route::get('siteplane/page', 'SitePlanView')->middleware('auth')->name('siteplane/page');
});

// Route::get('klusterperumahan/add/new', KlusterPerumahanForm::class)->middleware('auth')->name('klusterperumahan/add/new');
// Route::get('/klusterperumahan/edit/{id}', KlusterPerumahanForm::class)->name('klusterperumahan/edit');
// Route::controller(KlusterPerumahanController::class)->group(function () {
//     Route::get('klusterperumahan/list/page', 'KlusterPerumahanList')->middleware('auth')->name('klusterperumahan/list/page');
//     Route::post('/klusterperumahan/delete', 'delete')->name('klusterperumahan/delete');
//     Route::get('get-cluster-data', 'dataCluster')->name('get-cluster-data');
// });

Route::controller(KavlingController::class)->group(function () {
    Route::get('kavling/list/page', 'KavlingList')->middleware('auth')->name('kavling/list/page');
    Route::get('booking/list/page', 'BookingList')->middleware('auth')->name('booking/list/page');
    Route::get('kavling/add/new', 'KavlingAddNew')->middleware('auth')->name('kavling/add/new');
    Route::post('form/kavling/save', 'saveRecordKavling')->middleware('auth')->name('form/kavling/save');
    Route::get('kavling/edit/{id}', 'edit')->middleware('auth')->name('kavling/edit');
    Route::get('booking/edit/{id}', 'editBooking')->middleware('auth')->name('booking/edit');
    Route::get('booking/detail/{id}', 'detailBooking')->middleware('auth')->name('booking/detail');
    Route::get('booking/konsumen/detail/{id}', 'detailKonsumen')->middleware('auth')->name('booking/konsumen/detail');
    Route::get('booking/konsumen/detail/{id}/pdf', [KavlingController::class, 'cetakKonsumen'])->name('booking/konsumen/detail/pdf');
    Route::post('kavling/update/{id}', 'updateKavling')->middleware('auth')->name('kavling/update');
    Route::post('booking/update/{id}', 'updateBooking')->middleware('auth')->name('booking/update');
    Route::get('/booking/file/delete/{file}', [KavlingController::class, 'deleteFile'])->name('booking/file/delete');
    Route::get('kavling/{id}/booking/new', 'kavlingAddBooking')->middleware('auth')->name('kavling/booking/new');
    // Route::get('booking/{booking}/status-update', 'addStatusBooking')->middleware('auth')->name('booking/status-update');
    // Route::post('form/booking/status-update/save', 'saveRecordStatusBooking')->middleware('auth')->name('form/booking/status-update/save');
    Route::get('booking/{booking}/status-update', [KavlingController::class, 'addStatusBooking'])->middleware('auth')->name('booking/status-update/show');
    Route::middleware('auth')->group(function () {
        Route::prefix('booking/{booking}/status-update')->name('booking.status-update.')->group(function () {
            Route::post('pemberkasan',   [KavlingController::class,'storePemberkasan'])->name('pemberkasan.store');
            Route::post('proses',        [KavlingController::class,'storeProses'])->name('proses.store');
            Route::post('analisa-bank',  [KavlingController::class,'storeAnalisa'])->name('analisa.store');
            Route::post('sp3k',          [KavlingController::class,'storeSp3k'])->name('sp3k.store');
            Route::post('akad-kredit',   [KavlingController::class,'storeAkad'])->name('akad.store');
            Route::post('ajb',           [KavlingController::class,'storeAjb'])->name('ajb.store');
            Route::post('ditolak-bank',  [KavlingController::class,'storeDitolak'])->name('ditolak.store');
            Route::post('mundur',        [KavlingController::class,'storeMundur'])->name('mundur.store');
        });
    });
    Route::get('spr/{booking}/add/new', [KavlingController::class, 'kavlingAddSpr'])->middleware('auth')->name('spr/add/new');
    Route::post('spr/update/{id}', 'updateSPR')->middleware('auth')->name('spr/update');
    Route::get('spr/edit/{id}', 'editSPR')->middleware('auth')->name('spr/edit');
    Route::post('form/spr/save', 'saveRecordSpr')->middleware('auth')->name('form/spr/save');
    Route::post('form/{id}/booking/save', 'saveRecordKavlingBooking')->middleware('auth')->name('form/booking/save');
    // Route::get('/booking/{booking}/generate-spr', [KavlingController::class, 'generateSpr'])->name('booking.generate-spr');
    Route::get('booking/list/page/{id}/pdf', [KavlingController::class, 'cetak'])->name('booking/list/page/pdf');
    // Route::post('kavling/{id}/booking', 'kavlingAddBooking')->middleware('auth')->name('kavling/update');
    Route::post('kavling/delete', 'delete')->middleware('auth')->name('kavling/delete');
    Route::post('booking/delete', 'deleteBooking')->middleware('auth')->name('booking/delete');
    Route::get('get-kavling-data', 'getKavling')->middleware('auth')->name('get-kavling-data');
    Route::get('get-booking-data', 'getBookingKavling')->middleware('auth')->name('get-booking-data');
});

Route::controller(FasumController::class)->group(function () {
    Route::get('fasum/list/page', 'FasumList')->middleware('auth')->name('fasum/list/page');
    Route::get('fasum/add/new', 'FasumAddNew')->middleware('auth')->name('fasum/add/new');
    Route::post('form/fasum/save', 'saveRecordFasum')->middleware('auth')->name('form/fasum/save');
    Route::get('fasum/edit/{id}', 'edit')->middleware('auth')->name('fasum/edit');
    Route::post('fasum/update/{id}', 'updateFasum')->middleware('auth')->name('fasum/update');
    Route::post('fasum/delete', 'delete')->middleware('auth')->name('fasum/delete');
    Route::get('get-fasum-data', 'getFasum')->middleware('auth')->name('get-fasum-data');
});

Route::controller(FasosController::class)->group(function () {
    Route::get('fasos/list/page', 'FasosList')->middleware('auth')->name('fasos/list/page');
    Route::get('fasos/add/new', 'FasosAddNew')->middleware('auth')->name('fasos/add/new');
    Route::post('form/fasos/save', 'saveRecordFasos')->middleware('auth')->name('form/fasos/save');
    Route::get('fasos/edit/{id}', 'edit')->middleware('auth')->name('fasos/edit');
    Route::post('fasos/update/{id}', 'updateFasos')->middleware('auth')->name('fasos/update');
    Route::post('fasos/delete', 'delete')->middleware('auth')->name('fasos/delete');
    Route::get('get-fasos-data', 'getFasos')->middleware('auth')->name('get-fasos-data');
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
    // Route::get('suratperintahpembangunan/{id}/json', 'getDetailJson')->middleware('auth')->name('suratperintahpembangunan/json');
    Route::post('suratperintahpembangunan/update/{id}', [SuratPerintahPembangunanController::class, 'update'])->name('suratperintahpembangunan/update');
    Route::post('suratperintahpembangunan/delete', [SuratPerintahPembangunanController::class, 'bulkDelete'])->name('suratperintahpembangunan/delete');    
    Route::get('get-surat-perintah-pembangunan-data', [SuratPerintahPembangunanController::class, 'getSuratPerintahPembangunan'])->name('get-surat-perintah-pembangunan-data');
    Route::get('suratperintahpembangunan/update/{id}/pdf', [SuratPerintahPembangunanController::class, 'cetak'])->name('suratperintahpembangunan/update/pdf');
});

// ----------------------------- Projek - (INTERNSHIP TEAM) ----------------------------//
// ----------------------------- Projek sub-Lahan - (INTERNSHIP TEAM) ----------------------------//
Route::controller(MasterBiayaLahanController::class)->group(function () {
    Route::get('masterbiayalahan/list/page', 'MasterBiayaLahanList')->middleware('auth')->name('masterbiayalahan/list/page');
    Route::get('masterbiayalahan/add/new', 'MasterBiayaLahanAddNew')->middleware('auth')->name('masterbiayalahan/add/new');
    Route::post('form/masterbiayalahan/save', 'saveRecordMasterBiayaLahan')->middleware('auth')->name('form/masterbiayalahan/save');
    Route::get('masterbiayalahan/edit/{id}', [MasterBiayaLahanController::class, 'edit'])->name('masterbiayalahan/edit');
    Route::post('masterbiayalahan/update/{id}', [MasterBiayaLahanController::class, 'update'])->name('masterbiayalahan/update');
    Route::post('masterbiayalahan/delete', [MasterBiayaLahanController::class, 'delete'])->name('masterbiayalahan/delete');
    Route::get('get-masterbiayalahan-data', [MasterBiayaLahanController::class, 'getMasterBiayaLahan'])->name('get-masterbiayalahan-data');
});

Route::controller(DataLahanController::class)->group(function () {
    Route::get('datalahan/list/page', 'DataLahanList')->middleware('auth')->name('datalahan/list/page');
    Route::get('datalahan/add/new', 'DataLahanAddNew')->middleware('auth')->name('datalahan/add/new');
    Route::post('form/datalahan/save', 'saveRecordDataLahan')->middleware('auth')->name('form/datalahan/save');
    Route::get('datalahan/edit/{id}', [DataLahanController::class, 'edit'])->name('datalahan/edit');
    Route::post('datalahan/update/{id}', [DataLahanController::class, 'update'])->name('datalahan/update');
    Route::post('datalahan/delete', [DataLahanController::class, 'delete'])->name('datalahan/delete');
    Route::get('get-datalahan-data', [DataLahanController::class, 'getDataLahan'])->name('get-datalahan-data');
});

Route::controller(PerencanaanPembangunanController::class)->group(function () {
    Route::get('perencanaanpembangunan/list/page', 'PerencanaanPembangunanList')->middleware('auth')->name('perencanaanpembangunan/list/page');
});

Route::controller(PekerjaController::class)->group(function () {
    Route::get('pekerja/list/page', 'pekerjaList')->middleware('auth')->name('pekerja/list/page');
    Route::get('pekerja/add/new', 'pekerjaAddNew')->middleware('auth')->name('pekerja/add/new');
    Route::post('form/pekerja/save', 'saveRecordpekerja')->middleware('auth')->name('form/pekerja/save');
    Route::get('pekerja/edit/{id}', [PekerjaController::class, 'edit'])->name('pekerja/edit');
    Route::post('pekerja/update/{id}', [PekerjaController::class, 'update'])->name('pekerja/update');
    Route::post('pekerja/delete', [PekerjaController::class, 'delete'])->name('pekerja/delete');
    Route::get('get-pekerja-data', [PekerjaController::class, 'getpekerja'])->name('get-pekerja-data');
});

Route::controller(SpkMandorPekerjaController::class)->group(function () {
    Route::get('spkmandorpekerja/list/page', 'SpkMandorPekerjaList')->middleware('auth')->name('spkmandorpekerja/list/page');
    Route::get('spkmandorpekerjainternal/add/new', 'SpkMandorPekerjaInternalAddNew')->middleware('auth')->name('spkmandorpekerjainternal/add/new');
    Route::get('spkmandorpekerjasubcon/add/new', 'SpkMandorPekerjaSubconAddNew')->middleware('auth')->name('spkmandorpekerjasubcon/add/new');
    Route::post('form/spkmandorpekerja/save', 'saveRecordSpkMandorPekerja')->middleware('auth')->name('form/spkmandorpekerja/save');
    Route::post('form/spkmandorpekerjasubcon/save', 'saveRecordSpkMandorPekerjaSubcon')->middleware('auth')->name('form/spkmandorpekerjasubcon/save');
    Route::get('spkmandorpekerjainternal/edit/{id}', [SpkMandorPekerjaController::class, 'editInternal'])->name('spkmandorpekerjainternal/edit');
    Route::get('/spkmandorpekerjainternal/file/delete/{file}', [SpkMandorPekerjaController::class, 'deleteFile'])->name('spkmandorpekerjainternal/file/delete');
    Route::get('spkmandorpekerjasubcon/edit/{id}', [SpkMandorPekerjaController::class, 'editSubcon'])->name('spkmandorpekerjasubcon/edit');
    Route::post('spkmandorpekerjainternal/update/{id}', [SpkMandorPekerjaController::class, 'updateInternal'])->name('spkmandorpekerjainternal/update');
    Route::post('spkmandorpekerjasubcon/update/{id}', [SpkMandorPekerjaController::class, 'updateSubcon'])->name('spkmandorpekerjasubcon/update');
    Route::post('spkmandorpekerja/delete', [SpkMandorPekerjaController::class, 'delete'])->name('spkmandorpekerja/delete');
    Route::get('get-spkmandorpekerja-data', [SpkMandorPekerjaController::class, 'getSpkMandorPekerja'])->name('get-spkmandorpekerja-data');
    Route::post('spkmandorpekerja/store-ajax', [SpkMandorPekerjaController::class, 'storeAjax'])->middleware('auth')->name('spkmandorpekerja/store-ajax');
});

Route::post('/spkmandorpekerja/{id}/approve', [SpkMandorPekerjaController::class, 'approve'])->name('spkmandorpekerja/approve')->middleware('auth');

Route::get('spk/kapling-by-spp', [SpkMandorPekerjaController::class, 'kaplingBySpp'])
    ->middleware('auth')->name('spk/kapling-by-spp');

Route::get('spk/kaplings-by-spp', [SpkMandorPekerjaController::class, 'kaplingsBySpp'])
->middleware('auth')->name('spk/kaplings-by-spp');


Route::controller(RabrapController::class)->group(function () {
    Route::get('rabrap/list/page', 'RabrapList')->middleware('auth')->name('rabrap/list/page');
    Route::get('rabrap/add/new', 'RabrapAddNew')->middleware('auth')->name('rabrap/add/new');
    Route::post('form/rabrap/save', 'simpanRabRap')->middleware('auth')->name('form/rabrap/save');
    Route::get('/rabrap/edit/{id}', [RabrapController::class, 'edit'])->name('rabrap/edit');
    Route::post('/rabrap/update/{id}', [RabrapController::class, 'updateRabRap'])->name('rabrap/update');
    Route::post('/rabrap/delete', [RabrapController::class, 'delete'])->name('rabrap/delete');
    Route::get('get-rabrap-data', [RabrapController::class, 'getRabrap'])->name('get-rabrap-data');
});
Route::get('get-raprab2-data', [RabrapController::class, 'RabrapAddNew'])->name('get-raprab2-data');


Route::controller(PengajuanBahanBangunanController::class)->group(function () {
    Route::get('pengajuanbahanbangunan/list/page', 'PengajuanBahanBangunanList')->middleware('auth')->name('pengajuanbahanbangunan/list/page');
    Route::get('pengajuanbahanbangunan/add/new', 'PengajuanBahanBangunanAddNew')->middleware('auth')->name('pengajuanbahanbangunan/add/new');
    Route::post('form/pengajuanbahanbangunan/save', 'saveRecordPengajuanBahanBangunan')->middleware('auth')->name('form/pengajuanbahanbangunan/save');
    Route::get('pengajuanbahanbangunan/edit/{id}', [PengajuanBahanBangunanController::class, 'edit'])->name('pengajuanbahanbangunan/edit');
    Route::post('pengajuanbahanbangunan/update/{id}', [PengajuanBahanBangunanController::class, 'update'])->name('pengajuanbahanbangunan/update');
    Route::post('pengajuanbahanbangunan/delete', [PengajuanBahanBangunanController::class, 'delete'])->name('pengajuanbahanbangunan/delete');
    Route::get('get-pengajuanbahanbangunan-data', [PengajuanBahanBangunanController::class, 'getPengajuanBahanBangunan'])->name('get-pengajuanbahanbangunan-data');
});

Route::controller(PengajuanBahanLainyaController::class)->group(function () {
    Route::get('pengajuanbahanlainya/list/page', 'PengajuanBahanLainyaList')->middleware('auth')->name('pengajuanbahanlainya/list/page');
    Route::get('pengajuanbahanlainya/add/new', 'PengajuanBahanLainyaAddNew')->middleware('auth')->name('pengajuanbahanlainya/add/new');
    Route::post('form/pengajuanbahanlainya/save', 'saveRecordPengajuanBahanLainya')->middleware('auth')->name('form/pengajuanbahanlainya/save');
    Route::get('pengajuanbahanlainya/edit/{id}', [PengajuanBahanLainyaController::class, 'edit'])->name('pengajuanbahanlainya/edit');
    Route::post('pengajuanbahanlainya/update/{id}', [PengajuanBahanLainyaController::class, 'update'])->name('pengajuanbahanlainya/update');
    Route::post('pengajuanbahanlainya/delete', [PengajuanBahanLainyaController::class, 'delete'])->name('pengajuanbahanlainya/delete');
    Route::get('get-pengajuanbahanlainya-data', [PengajuanBahanLainyaController::class, 'getPengajuanBahanLainya'])->name('get-pengajuanbahanlainya-data');
});


Route::controller(KemajuanPembangunanController::class)->group(function () {
    Route::get('kemajuanpembangunan/list/page', 'KemajuanPembangunanList')->middleware('auth')->name('kemajuanpembangunan/list/page');
    Route::get('kemajuanpembangunan/add/new', 'KemajuanPembangunanAddNew')->middleware('auth')->name('kemajuanpembangunan/add/new');
    Route::post('form/kemajuanpembangunan/save', 'saveRecordKemajuanPembangunan')->middleware('auth')->name('form/kemajuanpembangunan/save');
    Route::get('kemajuanpembangunan/edit/{id}', [KemajuanPembangunanController::class, 'edit'])->name('kemajuanpembangunan/edit');
    Route::post('kemajuanpembangunan/update/{id}', [KemajuanPembangunanController::class, 'update'])->name('kemajuanpembangunan/update');
    Route::post('kemajuanpembangunan/delete', [KemajuanPembangunanController::class, 'delete'])->name('kemajuanpembangunan/delete');
    Route::get('get-kemajuanpembangunan-data', [KemajuanPembangunanController::class, 'getKemajuanPembangunan'])->name('get-kemajuanpembangunan-data');
});