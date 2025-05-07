<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tindakan;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use App\Models\Skor_Pelanggaran;


class Monitoring_pelanggaranController extends Controller
{
    public function index(Request $request){
        $query = Pelanggaran::with(['siswa.kelas', 'skor_pelanggaran']);

        // Filter berdasarkan nama siswa
        if ($request->filled('nama_siswa')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama_siswa', 'like', '%' . $request->nama_siswa . '%');
            });
        }

        // Filter berdasarkan jurusan
        if ($request->filled('jurusan')) {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('jurusan', 'like', '%' . $request->jurusan . '%');
            });
        }

        // Filter berdasarkan nama pelanggaran
        if ($request->filled('nama_pelanggaran')) {
            $query->whereHas('skor_pelanggaran', function ($q) use ($request) {
                $q->where('nama_pelanggaran', 'like', '%' . $request->nama_pelanggaran . '%');
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $pelanggaran = Pelanggaran::with(['siswa.kelas', 'skor_pelanggaran'])
        ->when($request->nama_siswa, function ($query) use ($request) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama_siswa', 'like', '%' . $request->nama_siswa . '%');
            });
        })
        ->when($request->jurusan, function ($query) use ($request) {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('jurusan', 'like', '%' . $request->jurusan . '%');
            });
        })
        ->when($request->nama_pelanggaran, function ($query) use ($request) {
            $query->whereHas('skor_pelanggaran', function ($q) use ($request) {
                $q->where('nama_pelanggaran', 'like', '%' . $request->nama_pelanggaran . '%');
            });
        })
        ->when($request->tanggal, function ($query) use ($request) {
            $query->whereDate('tanggal', $request->tanggal);
        })
        ->when($request->bulan, function ($query) use ($request) {
            $query->whereMonth('tanggal', $request->bulan);
        })
        ->when($request->tahun, function ($query) use ($request) {
            $query->whereYear('tanggal', $request->tahun);
        })
        ->orderBy('tanggal', 'desc')
        ->paginate(10); // kamu bisa ganti jadi 10 kalau mau
    
    


        // Data lainnya
        $siswaList = Siswa::all();
        $kelasList = Kelas::all();
        $skorList = Skor_Pelanggaran::all();

        $totalSkor = Pelanggaran::selectRaw('id_siswa, SUM(skor_pelanggaran.skor) as total')
            ->join('skor_pelanggaran', 'pelanggaran.id_skor_pelanggaran', '=', 'skor_pelanggaran.id')
            ->groupBy('id_siswa')
            ->pluck('total', 'id_siswa');

        $siswaWithWarning = $totalSkor->filter(fn($skor) => $skor >= 1000);
        $siswaPeringatan = Siswa::whereIn('id', $siswaWithWarning->keys())->get();

        return view('monitoring-pelanggaran.index', compact(
            'pelanggaran', 'siswaList', 'kelasList', 'skorList', 'totalSkor', 'siswaPeringatan'
        ));
    }

    public function peringatan()
    {
        $siswaList = Siswa::with('kelas')->get();

        $totalSkor = Pelanggaran::selectRaw('id_siswa, SUM(skor_pelanggaran.skor) as total')
            ->join('skor_pelanggaran', 'pelanggaran.id_skor_pelanggaran', '=', 'skor_pelanggaran.id')
            ->groupBy('id_siswa')
            ->pluck('total', 'id_siswa');

        return view('monitoring-pelanggaran.peringatan', compact('siswaList', 'totalSkor'));
    }

    public function tindakan($id)
    {
        $siswa = Siswa::with(['kelas', 'tindakan'])->findOrFail($id);
        return view('monitoring-pelanggaran.tindakan', compact('siswa'));
    }


    public function simpanTindakan(Request $request)
    {
    Tindakan::create([
        'id_siswa' => $request->id_siswa,
        'tindakan' => $request->tindakan,
        'catatan' => $request->catatan,
    ]);

    return redirect()->route('monitoring.peringatan')->with('success', 'Tindakan berhasil disimpan.');
    }

    public function editTindakan($id)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = Siswa::with(['tindakan'])->findOrFail($id);
        
        return view('monitoring-pelanggaran.edit-tindakan', compact('siswa'));
    }

    public function hapusTindakan($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        $tindakan->delete();

        return redirect()->back()->with('success', 'Tindakan berhasil dihapus.');
    }


}
