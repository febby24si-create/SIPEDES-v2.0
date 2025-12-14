<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $jabatan_filter = $request->get('jabatan_filter');
        $status_filter = $request->get('status_filter');

        $perangkats = PerangkatDesa::with('warga')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('warga', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");
                })->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('kontak', 'like', "%{$search}%");
            })
            ->when($jabatan_filter, function ($query) use ($jabatan_filter) {
                $query->where('jabatan', $jabatan_filter);
            })
            ->when($status_filter, function ($query) use ($status_filter) {
                if ($status_filter == 'aktif') {
                    $query->where(function ($q) {
                        $q->whereNull('periode_selesai')
                            ->orWhere('periode_selesai', '>=', now());
                    });
                } else if ($status_filter == 'tidak_aktif') {
                    $query->where('periode_selesai', '<', now());
                }
            })
            ->orderByRaw("CASE WHEN periode_selesai IS NULL OR periode_selesai >= CURDATE() THEN 0 ELSE 1 END")
            ->orderBy('jabatan')
            ->orderBy('periode_mulai', 'desc')
            ->paginate(10);

        // Ambil daftar jabatan unik untuk filter
        $jabatan_list = PerangkatDesa::distinct()->pluck('jabatan');

        return view('pages.perangkat_desa.index', compact('perangkats', 'jabatan_list'));
    }

    public function create()
    {
        $wargas = Warga::all();
        return view('pages.perangkat_desa.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:20',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('perangkat_desa', 'public');
        }

        PerangkatDesa::create($data);

        return redirect()->route('admin.perangkat_desa.index')
            ->with('success', 'Perangkat desa berhasil ditambahkan.');
    }

    public function show(PerangkatDesa $perangkatDesa)
    {
        return view('pages.perangkat_desa.show', compact('perangkatDesa'));
    }

    public function edit(PerangkatDesa $perangkatDesa)
    {
        $wargas = Warga::all();
        return view('pages.perangkat_desa.edit', compact('perangkatDesa', 'wargas'));
    }

    public function update(Request $request, PerangkatDesa $perangkatDesa)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:20',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($perangkatDesa->foto) {
                Storage::disk('public')->delete($perangkatDesa->foto);
            }
            $data['foto'] = $request->file('foto')->store('perangkat_desa', 'public');
        }

        $perangkatDesa->update($data);

        return redirect()->route('admin.perangkat_desa.index')
            ->with('success', 'Perangkat desa berhasil diperbarui.');
    }

    public function destroy(PerangkatDesa $perangkatDesa)
    {
        if ($perangkatDesa->foto) {
            Storage::disk('public')->delete($perangkatDesa->foto);
        }

        $perangkatDesa->delete();

        return redirect()->route('admin.perangkat_desa.index')
            ->with('success', 'Perangkat desa berhasil dihapus.');
    }
}
