<?php

use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PeriksaPasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\RiwayatPasienController;
use App\Http\Controllers\UserController;
use App\Models\Konsultasi;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('starting');

Route::get('login-admin', [UserController::class, 'loginAdminForm'])->name('login.admin');
Route::post('submit-login-Admin', [UserController::class, 'loginAdmin'])->name('submit.login.admin');
Route::get('/register-admin', [UserController::class, 'registerAdminForm'])->name('register.admin');
Route::post('/submit-register-admin', [UserController::class, 'registerAdmin'])->name('submit.register.admin');

Route::get('/register-pasien', [PasienController::class, 'registerPasienForm'])->name('register.pasien');
Route::post('/submit-register-pasien', [PasienController::class, 'registerPasien'])->name('submit.register.pasien');
Route::get('/login-pasien', [PasienController::class, 'LoginPasienForm'])->name('login.pasien');
Route::post('/submit-login-pasien', [PasienController::class, 'LoginPasien'])->name('submit.login.pasien');


Route::get('/login-dokter', [DokterController::class, 'loginDokterForm'])->name('login.dokter');
Route::post('/submit-login-dokter', [DokterController::class, 'loginDokter'])->name('submit.login.dokter');

Route::get('/daftar-poli/jadwal', [DaftarPoliController::class, 'getJadwal'])->name('get.jadwal');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['user.akses:admin'])->group(function () {
        Route::get('/profil-admin', [UserController::class, 'profilAdmin'])->name('profil.admin');
        Route::post('/update-profil-admin', [UserController::class, 'updateProfilAdmin'])->name('update.profil.admin');
        Route::get('/index-admin', [UserController::class, 'getAllAdmin'])->name('index.admin');
        Route::get('/create-admin', [UserController::class, 'createAdminForm'])->name('create.admin');
        Route::post('/submit-create-admin', [UserController::class, 'createAdmin'])->name('submit.create.admin');
        Route::delete('/delete-admin/{id}', [UserController::class, 'deleteAdmin'])->name('delete.admin');
        Route::post('/logout-admin', [UserController::class, 'logoutAdmin'])->name('logout.admin');

        Route::get('/index-poli', [PoliController::class, 'index'])->name('index.poli');
        Route::get('/create-poli', [PoliController::class, 'createPoliForm'])->name('create.poli');
        Route::post('/submit-create-poli', [PoliController::class, 'createPoli'])->name('submit.create.poli');
        Route::put('/update-poli/{id}', [PoliController::class, 'updatePoli'])->name('update.poli');
        Route::delete('/delete-poli/{id}', [PoliController::class, 'deletePoli'])->name('delete.poli');

        Route::get('/index-pasien', [PasienController::class, 'index'])->name('index.pasien');
        Route::get('/create-pasien', [PasienController::class, 'createPasienForm'])->name('create.pasien');
        Route::post('/submit-create-pasien', [PasienController::class, 'createPasien'])->name('submit.create.pasien');
        Route::put('/update-pasien/{id}', [PasienController::class, 'updatePasien'])->name('update.pasien');
        Route::delete('/delete-pasien/{id}', [PasienController::class, 'deletePasien'])->name('delete.pasien');

        Route::get('/index-dokter', [DokterController::class, 'index'])->name('index.dokter');
        Route::get('/register-dokter', [DokterController::class, 'registerDokterForm'])->name('register.dokter');
        Route::post('/submit-register-dokter', [DokterController::class, 'registerDokter'])->name('submit.register.dokter');
        Route::put('/update-dokter/{id}', [DokterController::class, 'updateDokter'])->name('update.dokter');
        Route::delete('/delete-dokter/{id}', [DokterController::class, 'deleteDokter'])->name('delete.dokter');

        Route::get('/index-obat', [ObatController::class, 'index'])->name('index.obat');
        Route::get('/create-obat', [ObatController::class, 'createObatForm'])->name('create.obat');
        Route::post('/submit-create-obat', [ObatController::class, 'createObat'])->name('submit.create.obat');
        Route::put('/update-obat/{id}', [ObatController::class, 'updateObat'])->name('update.obat');
        Route::delete('/delete-obat/{id}', [ObatController::class, 'deleteObat'])->name('delete.obat');
    });

    Route::middleware(['user.akses:dokter, admin'])->group(function () {
        Route::get('/profil-dokter', [DokterController::class, 'profilDokter'])->name('profil.dokter');
        Route::post('/update-profil-dokter/{id}', [DokterController::class, 'updateProfilDokter'])->name('update.profil.dokter');
        Route::post('/logout-dokter', [DokterController::class, 'logoutDokter'])->name('logout.dokter');

        Route::get('/index-jadwalperiksa', [JadwalPeriksaController::class, 'index'])->name('index.jadwalperiksa');
        Route::get('/create-jadwalperiksa', [JadwalPeriksaController::class, 'createJadwalPeriksaForm'])->name('create.jadwalperiksa');
        Route::post('/submit-create-jadwalperiksa', [JadwalPeriksaController::class, 'createJadwalPeriksa'])->name('submit.create.jadwalperiksa');
        Route::put('/update-jadwalperiksa/{id}', [JadwalPeriksaController::class, 'updateJadwalPeriksa'])->name('update.jadwalperiksa');

        Route::get('/index-periksapasien', [PeriksaPasienController::class, 'index'])->name('index.periksapasien');
        Route::get('/periksapasien/{id}', [PeriksaPasienController::class, 'periksaPasienForm'])->name('periksapasien');
        Route::post('/submit-periksapasien/{id}', [PeriksaPasienController::class, 'periksaPasien'])->name('submit.periksapasien');
        Route::get('/update-periksapasien/{id}', [PeriksaPasienController::class, 'updatePeriksaForm'])->name('update.periksapasien');
        Route::put('/submit-updateperiksa/{id}', [PeriksaPasienController::class, 'updatePeriksa'])->name('update.periksa');

        Route::get('/index-riwayatpasien', [RiwayatPasienController::class, 'index'])->name('index.riwayatpasien');
        Route::get('/detail-riwayatpasienform/{id}', [RiwayatPasienController::class, 'detailRiwayatPasienForm'])->name('detail.riwayatpasienform');
        Route::get('/detail-riwayatpasien/{id}', [RiwayatPasienController::class, 'detailRiwayatPasien'])->name('detail.riwayatpasien');

        Route::get('/konsultasi-dokter', [KonsultasiController::class, 'indexDokter'])->name('index.konsultasi.dokter');
        Route::put('/update-tanggapan/{id}', [KonsultasiController::class, 'tanggapanDokter'])->name('tanggapan.dokter');
    });

    Route::middleware(['user.akses:pasien, admin'])->group(function () {
        Route::get('/profil-pasien', [PasienController::class, 'profilPasien'])->name('profil.pasien');
        Route::post('/update-profil-pasien/{id}', [PasienController::class, 'updateProfilPasien'])->name('update.profil.pasien');
        Route::post('/logout-pasien', [PasienController::class, 'logoutPasien'])->name('logout.pasien');

        Route::get('index.daftarpoli', [DaftarPoliController::class, 'index'])->name('index.daftarpoli');
        Route::get('/create-daftarpoli', [DaftarPoliController::class, 'createDaftarPoliForm'])->name('create.daftarpoli');
        Route::post('/submit-create-daftarpoli', [DaftarPoliController::class, 'createDaftarPoli'])->name('submit.create.daftarpoli');
        Route::get('/detail-daftarpoli/{id}', [DaftarPoliController::class, 'detailDaftarPoli'])->name('detail.daftarpoli');
        Route::get('/riwayat-daftarpoli/{id}', [DaftarPoliController::class, 'riwayatDaftarPoli'])->name('riwayat.daftarpoli');

        Route::get('/konsultasi-pasien', [KonsultasiController::class, 'indexPasien'])->name('index.konsultasi.pasien');
        Route::get('/create-konsultasi-pasien', [KonsultasiController::class, 'createKonsultasiPasienForm'])->name('form.konsultasi.pasien');
        Route::post('/submit-konsultasi-pasien', [KonsultasiController::class, 'createKonsultasiPasien'])->name('create.konsultasi.pasien');
        Route::put('/update-konsultasi/{id}', [KonsultasiController::class, 'updateKonsultasi'])->name('update.konsultasi');
        Route::delete('/delete-konsultasi/{id}', [KonsultasiController::class, 'deleteKonsultasi'])->name('delete.konsultasi');
    });
});
