<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    // Tampilkan form absensi per kelas
    public function catatanAbsensi($kelas_id)
    {
        $kelas = Kelas::with('siswas')->findOrFail($kelas_id);
        $hari_ini = now()->toDateString();

        // Ambil semua absensi hari ini
        $absensiHariIni = Absensi::whereIn('id_siswa', $kelas->siswas->pluck('id'))
            ->where('hari_tanggal', $hari_ini)
            ->get()
            ->keyBy('id_siswa');

        // Siswa yang BELUM absensi hari ini
        $siswasBelumAbsensi = $kelas->siswas->filter(function ($siswa) use ($absensiHariIni) {
            return !$absensiHariIni->has($siswa->id);
        });

        return view('absensi.catatan-absensi', compact('kelas', 'hari_ini', 'absensiHariIni', 'siswasBelumAbsensi'));
    }

    // Simpan absensi
    public function simpanAbsensi(Request $request, $kelas_id)
    {
        $request->validate([
            'absensi' => 'required|array',
            'hari_tanggal' => 'required|date',
        ]);
    
        $user_id = Auth::id();
        $hari_tanggal = $request->hari_tanggal;
    
        foreach ($request->absensi as $siswa_id => $absenData) {
    
            // Jika input tidak valid (bukan array), lewati
            if (!is_array($absenData)) continue;
    
            $status = $absenData['status'] ?? 'hadir';
            $fotoSurat = $absenData['foto_surat'] ?? null;

              // Ambil data siswa
            $siswa = Siswa::find($siswa_id);
    
            // Validasi: izin dan sakit wajib unggah surat
            if (in_array($status, ['izin', 'sakit']) && !$fotoSurat) {
                return back()->withErrors(["Atas nama {$siswa->nama_siswa}  harus mengunggah surat untuk status $status."]);
            }
    
            // Cek apakah siswa sudah absen hari ini
            $sudahAbsen = Absensi::where('id_siswa', $siswa_id)
                ->where('hari_tanggal', $hari_tanggal)
                ->exists();
    
            if ($sudahAbsen) {
                continue; // Lewati jika sudah absen
            }
    
            // Siapkan data
            $data = [
                'id_siswa' => $siswa_id,
                'hari_tanggal' => $hari_tanggal,
                'id_users' => $user_id,
                'status' => $status,
                'status_surat' => in_array($status, ['izin', 'sakit', 'alpha']) ? 'pending' : null,
            ];
    
            // Upload surat jika ada
            if ($fotoSurat) {
                $path = $fotoSurat->store('foto_surat', 'public');
                $data['foto_surat'] = $path;
            }
    
            Absensi::create($data);
        }
    
        return redirect()->route('absensi.catatan', $kelas_id)->with('message', 'Absensi berhasil disimpan.');
    }
    

    // Hapus absensi siswa tertentu
    public function hapusAbsensi($absensi_id)
    {
        $absensi = Absensi::findOrFail($absensi_id);

        // Hapus foto surat jika ada
        if ($absensi->foto_surat && Storage::disk('public')->exists($absensi->foto_surat)) {
            Storage::disk('public')->delete($absensi->foto_surat);
        }

        $absensi->delete();

        return back()->with('message', 'Absensi berhasil dihapus.');
    }

    public function validasiSurat($kelas_id)
    {

        $kelas = Kelas::with('siswas')->findOrFail($kelas_id);
        $hari_ini = now()->toDateString();

        // Ambil semua absensi hari ini
        $absensiHariIni = Absensi::whereIn('id_siswa', $kelas->siswas->pluck('id'))
            ->where('hari_tanggal', $hari_ini)
            ->get()
            ->keyBy('id_siswa');

       
        
        $absensis = Absensi::whereIn('id_siswa', $kelas->siswas->pluck('id'))
        ->where('status_surat', 'pending')
        ->whereNotNull('foto_surat')
        ->with('siswa')
        ->get();

        return view('./absensi.verifikasi-absensi', compact('absensis','kelas', 'hari_ini', 'absensiHariIni'));
    }

    public function approveSurat($absensi_id)
    {
        $absensi = Absensi::findOrFail($absensi_id);
        $absensi->status_surat = 'approved';
        $absensi->save();

        return back()->with('message', 'Surat berhasil disetujui.');
    }

    public function rejectSurat($absensi_id)
    {
        $absensi = Absensi::findOrFail($absensi_id);
        $absensi->status_surat = 'rejected';
        $absensi->save();

        return back()->with('message', 'Surat berhasil ditolak.');
    }


}
