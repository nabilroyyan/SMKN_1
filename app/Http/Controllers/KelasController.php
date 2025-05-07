<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;


class KelasController extends Controller
{
    public function index()
    {
        $classes = Kelas::all();
        return view('kelas.index', compact('classes'));
    }
    
    public function show($id)
    {
        $kelas = Kelas::with(['guru', 'siswas'])->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    public function create()
    {
        $gurus = Guru::whereDoesntHave('kelas')->get();
        $users = User::all();
        return view('kelas.create', compact('gurus','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tinkat' => 'required|string|max:255',
            'id_guru' => 'required|exists:guru,id',
        ]);
    
        // Cek apakah guru sudah menjadi wali di kelas lain
        $existingKelasGuru = Kelas::where('id_guru', $request->id_guru)->first();

        if ($existingKelasGuru) {
            return redirect()->back()->withErrors(['id_guru' => 'Guru ini sudah menjadi wali kelas lain.']);
        }

        // Simpan kelas baru
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'jurusan' => $request->jurusan,
            'tinkat' => $request->tinkat,
            'id_guru' => $request->id_guru,
            'id_users' => $request->id_users,
        ]);
    
        return redirect()->route('kelas.index')->with('message', 'Kelas berhasil dibuat.');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $users = User::all();
        $gurus = Guru::whereDoesntHave('kelas')
            ->orWhereHas('kelas', function ($query) use ($id) {
                $query->where('id', $id); // hanya guru yang jadi wali dari kelas ini
            })
            ->get();

        return view('kelas.edit', compact('kelas', 'gurus','users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tinkat' => 'required|string|max:255',
            'id_guru' => 'required|exists:guru,id',
            'id_users' => 'required|exists:users,id',
        ]);

        $kelas = Kelas::findOrFail($id);

        // Cek apakah guru sudah menjadi wali di kelas lain, kecuali kelas ini
        $existingKelasGuru = Kelas::where('id_guru', $request->id_guru)
            ->where('id', '!=', $id)
            ->first();

        if ($existingKelasGuru) {
            return redirect()->back()->withErrors(['id_guru' => 'Guru ini sudah menjadi wali kelas lain.']);
        }

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'jurusan' => $request->jurusan,
            'tinkat' => $request->tinkat,
            'id_guru' => $request->id_guru,
            'id_users' => $request->id_users,
        ]);

        return redirect()
            ->route('kelas.index')
            ->with('message', 'Kelas updated successfully');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('kelas.index')->with('message', 'Kelas berhasil dihapus.');
    }

    public function addSiswaForm($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $siswas = Siswa::whereDoesntHave('kelas')->get(); // hanya siswa yang belum memiliki kelas

        return view('kelas.add_siswa', compact('kelas', 'siswas'));
    }

    public function addSiswa(Request $request, $kelas_id)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'siswa_ids.*' => 'exists:siswa,id',
        ]);

        $kelas = Kelas::findOrFail($kelas_id);
        $kelas->siswas()->syncWithoutDetaching($request->siswa_ids);

        return redirect("/kelas/{$kelas_id}")->with('message', 'Siswa berhasil ditambahkan ke kelas.');
    }
    

    public function removeSiswa($kelas_id, $siswa_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);

        // Detach siswa dari kelas
        $kelas->siswas()->detach($siswa_id);

        return redirect()
            ->route('kelas.show', $kelas_id)
            ->with('message', 'Siswa berhasil dihapus dari kelas.');
    }
}
