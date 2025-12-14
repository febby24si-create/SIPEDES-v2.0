<?php

namespace App\Http\Controllers;

use App\Models\JabatanLembaga;
use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class JabatanLembagaController extends Controller
{
    public function index($lembaga_id)
    {
        $lembaga = LembagaDesa::findOrFail($lembaga_id);
        $jabatans = JabatanLembaga::where('lembaga_id', $lembaga_id)->get();

        return view('pages.jabatan_lembaga.index', compact('lembaga', 'jabatans'));
    }

    public function create($lembaga_id)
    {
        $lembaga = LembagaDesa::findOrFail($lembaga_id);
        return view('pages.jabatan_lembaga.create', compact('lembaga'));
    }

    public function store(Request $request, $lembaga_id)
    {
        $request->validate([
            'nama_jabatan' => 'required|max:100',
            'level' => 'required|in:Ketua,Sekretaris,Bendahara,Anggota,Lainnya',
        ]);

        JabatanLembaga::create([
            'lembaga_id' => $lembaga_id,
            'nama_jabatan' => $request->nama_jabatan,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.lembaga.jabatan.index', $lembaga_id)
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit($lembaga_id, $id)
    {
        $lembaga = LembagaDesa::findOrFail($lembaga_id);
        $jabatan = JabatanLembaga::findOrFail($id);

        return view('pages.lembaga.edit', compact('lembaga', 'jabatan'));
    }

    public function update(Request $request, $lembaga_id, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|max:100',
            'level' => 'required|in:Ketua,Sekretaris,Bendahara,Anggota,Lainnya',
        ]);

        $jabatan = JabatanLembaga::findOrFail($id);
        $jabatan->update($request->all());

        return redirect()->route('admin.lembaga.jabatan.index', $lembaga_id)
            ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy($lembaga_id, $id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('admin.lembaga.jabatan.index', $lembaga_id)
            ->with('success', 'Jabatan berhasil dihapus.');
    }
}
