<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MonitoringAbsensiController extends Controller
{
    // Fungsi untuk menampilkan absensi dengan filter kelas dan tanggal
    public function index(Request $request)
    {
        $query = Absensi::query();

        // Filter berdasarkan kelas
        if ($request->has('kelas_id') && $request->kelas_id != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('id_kelas', $request->kelas_id);
            });
        }

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('hari_tanggal', $request->tanggal);
        }

        $absensi = $query->get();

        // Mengambil semua kelas untuk filter
        $kelas = Kelas::all();

        return view('./absensi/monitoring-absensi', compact('absensi', 'kelas'));
    }
}
