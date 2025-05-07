<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $students = Siswa::all();
        return view('siswa.index', compact('students'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nisn' => 'required|string|unique:siswa,nisn',
            'tempat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:255',
            'status_dalam_keluarga' => 'required|string|max:255',
            'anak_ke' => 'required|integer',
            'alamat_peserta_didik' => 'required|string',
            'nomer_telepon_rumah' => 'nullable|string|max:255',
            'sekolah_asal' => 'required|string|max:255',
            'diterima_disekolah_pada_tanggal' => 'required|date',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'alamat_orangtua' => 'required|string',
            'pekerjaan_ayah' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'foto_siswa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

    
        if ($request->hasFile('foto_siswa')) {
            $file = $request->file('foto_siswa');
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename); // simpan di public/images
            $data['foto_siswa'] = $filename;
        }
        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nisn' => 'required|string|unique:siswa,nisn,' . $siswa->id,
            'tempat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:255',
            'status_dalam_keluarga' => 'required|string|max:255',
            'anak_ke' => 'required|integer',
            'alamat_peserta_didik' => 'required|string',
            'nomer_telepon_rumah' => 'nullable|string|max:255',
            'sekolah_asal' => 'required|string|max:255',
            'diterima_disekolah_pada_tanggal' => 'required|date',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'alamat_orangtua' => 'required|string',
            'pekerjaan_ayah' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'foto_siswa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $siswa = Siswa::findOrFail($siswa->id);
        $input = $request->all();
        if ($request->hasFile('foto_siswa')) {
            // Hapus file lama (jika ada)
            if ($siswa->foto_siswa && file_exists(public_path('images/' . $siswa->foto_siswa))) {
                unlink(public_path('images/' . $siswa->foto_siswa));
            }
            // Simpan file  baru
            $file = $request->file('foto_siswa');
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $input['foto_siswa'] = $filename;
        } else {
            // Tidak upload file baru, jangan ubah yang lama
            unset($input['foto_siswa']);
        }

        $siswa->update($validatedData);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto_siswa) {
            Storage::disk('public')->delete($siswa->foto_siswa);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

}
