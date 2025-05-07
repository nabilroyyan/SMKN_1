<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Skor_Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelanggaranController extends Controller
{
    public function index()
    {
        $pelanggarans = Pelanggaran::with(['siswa', 'user', 'skor_pelanggaran'])->get();
        return view('catatan-pelanggaran.index', compact('pelanggarans'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        $skors = Skor_pelanggaran::all();

        return view('catatan-pelanggaran.create', compact('siswas', 'skors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ket_pelanggaran' => 'required|string',
            'bukti_pelanggaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal' => 'required|date',
            'id_siswa' => 'required|exists:siswa,id',
            'id_skor_pelanggaran' => 'required|exists:skor_pelanggaran,id',
        ]);

        $data = $request->all();

        // Tambahkan ID user yang sedang login
        $data['id_users'] = Auth::id();

        $input = $request->all();
    
        if ($request->hasFile('bukti_pelanggaran')) {
            $file = $request->file('bukti_pelanggaran');
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename); // simpan di public/images
            $data['bukti_pelanggaran'] = $filename;
        }
    
        Pelanggaran::create($data);

        return redirect()->route('pelanggaran.index')->with('message', 'Pelanggaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'user', 'skorPelanggaran'])->findOrFail($id);
        return view('pelanggaran.show', compact('pelanggaran'));
    }

    public function edit($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $siswas = Siswa::all();
        $users = User::all();
        $skors = Skor_pelanggaran::all();

        return view('catatan-pelanggaran.edit', compact('pelanggaran', 'siswas', 'users', 'skors'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'ket_pelanggaran' => 'required|string',
            'bukti_pelanggaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal' => 'required|date',
            'id_siswa' => 'required|exists:siswa,id',
            'id_skor_pelanggaran' => 'required|exists:skor_pelanggaran,id',
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);

        // Ambil semua data valid dari request
        $validatedData = $request->only(['ket_pelanggaran', 'id_siswa', 'id_skor_pelanggaran']);
        $validatedData['id_users'] = Auth::id(); // User login

        // Handle upload file jika ada
        $input = $request->all();
        if ($request->hasFile('bukti_pelanggaran')) {
            // Hapus file lama (jika ada)
            if ($pelanggaran->bukti_pelanggaran && file_exists(public_path('images/' . $pelanggaran->bukti_pelanggaran))) {
                unlink(public_path('images/' . $pelanggaran->bukti_pelanggaran));
            }
    
            $file = $request->file('bukti_pelanggaran');
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $input['bukti_pelanggaran'] = $filename;
        } else {
            // Tidak upload file baru, jangan ubah yang lama
            unset($input['bukti_pelanggaran']);
        }
        // Update data
        $pelanggaran->update($validatedData);

        return redirect()->route('pelanggaran.index')->with('message', 'Pelanggaran berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->delete();

        return redirect()->route('pelanggaran.index')->with('message', 'Pelanggaran berhasil dihapus.');
    }
}
