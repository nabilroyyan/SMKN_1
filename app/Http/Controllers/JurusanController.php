<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('jurusan.index', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255'
        ]);

        Jurusan::create($request->all());

        return redirect()->back()->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Jurusan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Jurusan berhasil dihapus.');
    }
}

