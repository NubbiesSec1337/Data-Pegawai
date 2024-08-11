<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil nilai pencarian nama dan posisi dari request
        $search = $request->input('search');
        $posisi = $request->input('posisi');

        // Menerapkan logika pencarian dan pengurutan
        $pegawai = Pegawai::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })
        ->when($posisi, function ($query, $posisi) {
            return $query->where('posisi', 'like', "%{$posisi}%");
        })
        ->orderBy($request->sortBy ?? 'nama', $request->sortDirection ?? 'asc')
        ->paginate(10);

        // Mengirim data pegawai ke view
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawais',
            'posisi' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawais,email,' . $pegawai->id,
            'posisi' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}

