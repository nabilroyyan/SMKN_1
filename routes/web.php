<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\Skor_pelanggaranController;
use App\Http\Controllers\Monitoring_pelanggaranController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MonitoringAbsensiController;
use App\Http\Controllers\VerifikasiAbsensiController;

Route::middleware(['guest'])->group(function(){ //agar sesudah login dan berada di halaman admin tidak bisa mengakses halaman login
    Route::get('/',[SesiController::class,'index'])->name('login'); //name('login'); supaya ketika kita mengakses link lain dan tidak login makan akan ter rediren ke halaman login
    Route::post('/',[SesiController::class,'login']);
});

Route::get('/home', function(){ //ketika sudah login dan berada di halaman admin kita tidak bisa mengakses halaman login dan terotomatis ter redirect ke halaman admin kembali
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function(){ // supaya ketika kita mengakses link lain dan tidak login makan akan ter rediren ke halaman login
    Route::get('/dashboard', [RoleController::class, 'superadmin'])->name('dashboard');
    Route::get('/tatip/dashboard',[RoleController::class,'tatip'])->middleware('UserAkses:tatip');
    Route::get('/admin/guru',[RoleController::class,'guru'])->middleware('UserAkses:guru');
    Route::get('/admin/siswa',[RoleController::class,'siswa'])->middleware('UserAkses:siswa');
    Route::get('/logout',[SesiController::class,'logout']);

    Route::get('/superadmin/user/index', [UserController::class, 'index']);
    Route::resource('user', \App\Http\Controllers\UserController::class);

    Route::get('/superadmin/siswa/index', [SiswaController::class, 'index']);
    Route::resource('siswa', \App\Http\Controllers\SiswaController::class);

    Route::get('/superadmin/guru/index', [GuruController::class, 'index']);
    Route::resource('guru', \App\Http\Controllers\GuruController::class);
    
    Route::get('/superadmin/kelas/index', [KelasController::class, 'index']);
    Route::resource('kelas', \App\Http\Controllers\KelasController::class);
    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
    Route::get('kelas/{kelas}/add-siswa', [KelasController::class, 'addSiswaForm'])->name('kelas.add-siswa.form');
    Route::post('kelas/{kelas}/add-siswa', [KelasController::class, 'addSiswa'])->name('kelas.add-siswa');
    Route::delete('/kelas/{kelas}/siswa/{siswa}', [KelasController::class, 'removeSiswa'])->name('kelas.remove-siswa');

    

    Route::prefix('superadmin/skor-pelanggaran')->name('skor-pelanggaran.')->group(function () {
        Route::get('/index', [Skor_pelanggaranController::class, 'index'])->name('index');
        Route::get('/create', [Skor_pelanggaranController::class, 'create'])->name('create');
        Route::post('/store', [Skor_pelanggaranController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [Skor_pelanggaranController::class, 'destroy'])->name('destroy');    
    });

    Route::prefix('superadmin/catatan-pelanggaran')->name('pelanggaran.')->group(function () {
        Route::get('/index', [PelanggaranController::class, 'index'])->name('index');
        Route::get('/create', [PelanggaranController::class, 'create'])->name('create');
        Route::post('/store', [PelanggaranController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PelanggaranController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PelanggaranController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PelanggaranController::class, 'destroy'])->name('destroy');    
        Route::get('/show/{id}', [PelanggaranController::class, 'show'])->name('show');
    });

    Route::prefix('superadmin/monitoring-pelanggaran')->name('monitoring.')->group(function () {
        Route::get('/index', [Monitoring_pelanggaranController::class, 'index'])->name('index');
        Route::get('/peringatan', [Monitoring_pelanggaranController::class, 'peringatan'])->name('peringatan');
        Route::get('/monitoring/tindakan/{id}', [Monitoring_pelanggaranController::class, 'tindakan'])->name('tindakan');
        Route::post('/monitoring/simpan-tindakan', [Monitoring_pelanggaranController::class, 'simpanTindakan'])->name('simpanTindakan');
        Route::delete('/tindakan/{id}', [Monitoring_pelanggaranController::class, 'hapusTindakan'])->name('tindakan.hapus');
    });

    Route::prefix('superadmin/absensi')->group(function () {
        Route::get('/absensi/{kelas_id}', [AbsensiController::class, 'catatanAbsensi'])->name('absensi.catatan');
        Route::post('/absensi/{kelas_id}', [AbsensiController::class, 'simpanAbsensi'])->name('absensi.simpan');
        Route::delete('/absensi/hapus/{absensi_id}', [AbsensiController::class, 'hapusAbsensi'])->name('absensi.hapus');
        Route::get('/validasi-surat/{kelas_id}', [AbsensiController::class, 'validasiSurat'])->name('absensi.validasi');
        Route::post('/absensi/approve/{absensi_id}', [AbsensiController::class, 'approveSurat'])->name('absensi.approve');
        Route::post('/absensi/reject/{absensi_id}', [AbsensiController::class, 'rejectSurat'])->name('absensi.reject');

    });



});


