<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RwController extends Controller
{
    public function index(Request $request)
    {
        $query = Rw::query()->withCount(['rts', 'wargas']);

        // Search berdasarkan nomor RW atau nama ketua RW
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_rw', 'LIKE', "%{$request->search}%")
                    ->orWhere('nama_ketua_rw', 'LIKE', "%{$request->search}%");
            });
        }

        // Filter status
        if ($request->status && $request->status != 'Semua') {
            $query->where('status', $request->status);
        }

        $rws = $query->orderBy('nomor_rw')->paginate(10);

        return view('pages.wilayah.rw.index', compact('rws'));
    }

    public function create()
    {
        return view('pages.wilayah.rw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_rw' => 'required|min:1|max:99|unique:rws,nomor_rw',
            'nama_ketua_rw' => 'required|string|max:100',
            'kontak_rw' => 'nullable|string|max:20',
            'alamat_rw' => 'nullable|string',
            'status' => 'required|in:Aktif,Nonaktif'
        ]);

        try {
            DB::beginTransaction();

            Rw::create($request->all());

            DB::commit();

            return redirect()->route('admin.rw.index')
                ->with('success', 'Data RW berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $rw = Rw::with(['rts' => function ($query) {
            $query->withCount('wargas')->orderBy('nomor_rt');
        }, 'wargas'])
            ->withCount(['rts', 'wargas'])
            ->findOrFail($id);

        return view('pages.wilayah.rw.show', compact('rw'));
    }

    public function edit($id)
    {
        $rw = Rw::findOrFail($id);
        return view('pages.wilayah.rw.edit', compact('rw'));
    }

    public function update(Request $request, $id)
    {
        $rw = Rw::findOrFail($id);

        $request->validate([
            'nomor_rw' => 'required|min:1|max:99|unique:rws,nomor_rw,' . $id . ',id',
            'nama_ketua_rw' => 'required|string|max:100',
            'kontak_rw' => 'nullable|string|max:20',
            'alamat_rw' => 'nullable|string',
            'status' => 'required|in:Aktif,Nonaktif'
        ]);

        try {
            DB::beginTransaction();

            $rw->update($request->all());

            DB::commit();

            return redirect()->route('admin.rw.index')
                ->with('success', 'Data RW berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $rw = Rw::findOrFail($id);

        // Cek apakah RW memiliki RT
        if ($rw->rts()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus RW yang masih memiliki RT.');
        }

        // Cek apakah RW memiliki warga
        if ($rw->wargas()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus RW yang masih memiliki warga.');
        }

        try {
            DB::beginTransaction();

            $rw->delete();

            DB::commit();

            return redirect()->route('admin.rw.index')
                ->with('success', 'Data RW berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function setKetua($id)
    {
        // Logic untuk set ketua RW
        $rw = Rw::findOrFail($id);
        // ... logic set ketua
        return redirect()->back()->with('success', 'Ketua RW berhasil ditetapkan.');
    }
}
