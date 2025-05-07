<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $teachers = Guru::all();
        return view('guru.index', compact('teachers'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'matpel' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Guru::create([
            'nama_guru' => $request->nama_guru,
            'matpel' => $request->matpel,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('guru.index')
            ->with('message', 'Guru created successfully');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'matpel' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $guru->update([
            'nama_guru' => $request->nama_guru,
            'matpel' => $request->matpel,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('guru.index')
            ->with('message', 'Guru updated successfully');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()
            ->route('guru.index')
            ->with('message', 'Guru deleted successfully');
    }
}