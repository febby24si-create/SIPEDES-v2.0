<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RtController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter_rw = $request->filter_rw;
        $filter_status = $request->filter_status;

        $rts = Rt::with(['rw', 'wargas'])
            ->withCount('wargas')
            ->when($search, function ($q) use ($search) {
                $q->where('nomor_rt', 'LIKE', "%$search%")
                    ->orWhere('nama_ketua_rt', 'LIKE', "%$search%")
                    ->orWhereHas('rw', function ($rw) use ($search) {
                        $rw->where('nomor_rw', 'LIKE', "%$search%");
                    });
            })
            ->when($filter_rw, function ($q) use ($filter_rw) {
                $q->where('rw_id', $filter_rw);
            })
            ->when($filter_status, function ($q) use ($filter_status) {
                $q->where('status', $filter_status);
            })
            ->orderBy('rw_id')
            ->orderBy('nomor_rt')
            ->paginate(10); // PAGINATION

        $rws = \App\Models\Rw::orderBy('nomor_rw')->get();

        return view('pages.wilayah.rt.index', compact('rts', 'rws'));
    }


    public function create()
    {
        $rws = Rw::active()->orderBy('nomor_rw')->get();
        return view('pages.wilayah.rt.create', compact('rws'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rw_id' => 'required|exists:rws,id',
            'nomor_rt' => 'required|integer|min:1|max:999',
            'nama_ketua_rt' => 'required|string|max:100',
            'kontak_rt' => 'nullable|string|max:20',
            'alamat_rt' => 'nullable|string',
            'status' => 'required|in:Aktif,Nonaktif'
        ]);

        // Cek duplikasi nomor RT dalam RW yang sama
        $existingRt = Rt::where('rw_id', $request->rw_id)
            ->where('nomor_rt', $request->nomor_rt)
            ->first();

        if ($existingRt) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nomor RT sudah ada di RW yang dipilih.');
        }

        try {
            DB::beginTransaction();

            Rt::create($request->all());

            DB::commit();

            return redirect()->route('admin.rt.index')
                ->with('success', 'Data RT berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $rt = Rt::with(['rw', 'wargas'])
            ->withCount('wargas')
            ->findOrFail($id);

        return view('pages.wilayah.rt.show', compact('rt'));
    }

    public function edit($id)
    {
        $rt = Rt::findOrFail($id);
        $rws = Rw::active()->orderBy('nomor_rw')->get();

        return view('pages.wilayah.rt.edit', compact('rt', 'rws'));
    }

    public function update(Request $request, $id)
    {
        $rt = Rt::findOrFail($id);

        $request->validate([
            'rw_id' => 'required|exists:rws,id',
            'nomor_rt' => 'required|min:1|max:999',
            'nama_ketua_rt' => 'required|string|max:100',
            'kontak_rt' => 'nullable|string|max:20',
            'alamat_rt' => 'nullable|string',
            'status' => 'required|in:Aktif,Nonaktif'
        ]);

        // Cek duplikasi nomor RT dalam RW yang sama (kecuali data saat ini)
        $existingRt = Rt::where('rw_id', $request->rw_id)
            ->where('nomor_rt', $request->nomor_rt)
            ->where('id', '!=', $id)
            ->first();

        if ($existingRt) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nomor RT sudah ada di RW yang dipilih.');
        }

        try {
            DB::beginTransaction();

            $rt->update($request->all());

            DB::commit();

            return redirect()->route('admin.rt.index')
                ->with('success', 'Data RT berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $rt = Rt::findOrFail($id);

        // Cek apakah RT memiliki warga
        if ($rt->wargas()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus RT yang masih memiliki warga.');
        }

        try {
            DB::beginTransaction();

            $rt->delete();

            DB::commit();

            return redirect()->route('admin.rt.index')
                ->with('success', 'Data RT berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Get RT by RW (untuk AJAX)
    public function getByRw($rwId)
    {
        $rts = Rt::where('rw_id', $rwId)
            ->active()
            ->orderBy('nomor_rt')
            ->get();

        return response()->json($rts);
    }
    public function setKetua($id)
    {
        // Logic untuk set ketua RT
        $rt = Rt::findOrFail($id);
        // ... logic set ketua
        return redirect()->back()->with('success', 'Ketua RT berhasil ditetapkan.');
    }
}
