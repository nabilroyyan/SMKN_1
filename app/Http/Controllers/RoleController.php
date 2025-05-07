<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\Skor_Pelanggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    
    function superadmin(){

    $bulanLabels = [];
    $jumlahPelanggaran = [];

    // Loop dari bulan Januari sampai Desember
    for ($i = 1; $i <= 12; $i++) {
        $bulan = Carbon::create(null, $i, 1)->translatedFormat('F'); // Contoh: Januari, Februari, dst
        $bulanLabels[] = $bulan;

        $count = Pelanggaran::whereMonth('tanggal', $i)
            ->whereYear('tanggal', now()->year)
            ->count();

        $jumlahPelanggaran[] = $count;
    }

    // Total pelanggaran keseluruhan
    $totalPelanggaran = Pelanggaran::count();

    // Total siswa
    $Totalsiswa = Siswa::count();
    $userss = User::all();

    // Total pelanggaran untuk hari ini
    $totalPelanggaranHariIni = Pelanggaran::whereDate('tanggal', Carbon::today())->count();

    // Kirim ke view dashboard
    return view('dashboard', [
        'bulanLabels' => json_encode($bulanLabels),
        'jumlahPelanggaran' => json_encode($jumlahPelanggaran),
        'totalPelanggaran' => $totalPelanggaran,
        'totalPelanggaranHariIni' => $totalPelanggaranHariIni,
        'Totalsiswa' => $Totalsiswa,
        'userss' => $userss,
    ]);
        
    }


    function tatip(){
        $bulanLabels = [];
        $jumlahPelanggaran = [];
    
        // Loop dari bulan Januari sampai Desember
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create(null, $i, 1)->translatedFormat('F'); // Contoh: Januari, Februari, dst
            $bulanLabels[] = $bulan;
    
            $count = Pelanggaran::whereMonth('tanggal', $i)
                ->whereYear('tanggal', now()->year)
                ->count();
    
            $jumlahPelanggaran[] = $count;
        }
    
        // Total pelanggaran keseluruhan
        $totalPelanggaran = Pelanggaran::count();
    
        // Total siswa
        $Totalsiswa = Siswa::count();
        $userss = User::all();
    
        // Total pelanggaran untuk hari ini
        $totalPelanggaranHariIni = Pelanggaran::whereDate('tanggal', Carbon::today())->count();
        return view('dashboard', [
            'bulanLabels' => json_encode($bulanLabels),
            'jumlahPelanggaran' => json_encode($jumlahPelanggaran),
            'totalPelanggaran' => $totalPelanggaran,
            'totalPelanggaranHariIni' => $totalPelanggaranHariIni,
            'Totalsiswa' => $Totalsiswa,
            'userss' => $userss,
        ]);
    }
    function bk(){
        return view('admin');
    }
    function sekretaris_kelas(){
        return view('admin');
    }
}
