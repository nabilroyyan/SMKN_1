<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class VerifikasiAbsensiController extends Controller
{
    // Fungsi untuk menampilkan absensi yang perlu diverifikasi
    public function index()
    {
        $absensi = Absensi::where('status', 'izin')
                         ->orWhere('status', 'sakit')
                         ->orWhere('status', 'alpha')
                         ->where('status_surat', 'pending')
                         ->get(); // Mengambil absensi dengan status surat 'pending'

        return view('./absensi/verifikasi-absensi', compact('absensi'));
    }

    // Fungsi untuk verifikasi absensi
    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status_surat' => 'required|in:approved,rejected'
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->status_surat = $request->status_surat;
        $absensi->save();

        return redirect()->route('superadmin.verifikasi-absensi.index')->with('success', 'Verifikasi berhasil!');
    }
}
