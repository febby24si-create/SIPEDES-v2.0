<?php
// app/Http/Controllers/LembagaDesaController.php
namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;
use App\Models\DokumenLembaga;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class LembagaDesaController extends Controller
{
    // Method untuk create view
    public function create()
    {
        return view('pages.lembaga.create');
    }

    public function index(Request $request)
    {
        $query = LembagaDesa::withCount(['anggotas', 'jabatans']);

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lembaga', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // FILTER JUMLAH ANGGOTA RANGE
        if ($request->min_anggota) {
            $query->having('anggotas_count', '>=', $request->min_anggota);
        }
        if ($request->max_anggota) {
            $query->having('anggotas_count', '<=', $request->max_anggota);
        }

        // FILTER TANGGAL DIBUAT
        if ($request->created_at) {
            $query->whereDate('created_at', $request->created_at);
        }

        // SORTING
        switch ($request->sort) {
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'anggota_terbanyak':
                $query->orderBy('anggotas_count', 'desc');
                break;
            case 'anggota_tersedikit':
                $query->orderBy('anggotas_count', 'asc');
                break;
            case 'a-z':
                $query->orderBy('nama_lembaga', 'asc');
                break;
            case 'z-a':
                $query->orderBy('nama_lembaga', 'desc');
                break;
            default: // terbaru
                $query->orderBy('created_at', 'desc');
                break;
        }

        // PAGINATION
        $lembagas = $query->paginate(10)->appends($request->except('page'));

        return view('pages.lembaga.index', compact('lembagas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lembaga' => 'required|max:100',
            'deskripsi' => 'required|min:50',
            'kontak' => 'nullable|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dokumen.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,mp4,avi,mov|max:50000',
        ]);

        $data = $request->only(['nama_lembaga', 'deskripsi', 'kontak']);

        // Upload logo
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('lembaga_desa/logo', 'public');
        }

        // Simpan lembaga TERLEBIH DAHULU
        $lembaga = LembagaDesa::create($data);

        // Upload multiple dokumen SETELAH lembaga dibuat
        if ($request->hasFile('dokumen')) {
            $this->uploadMultipleDokumen($request->file('dokumen'), $lembaga->id);
        }

        return redirect()->route('admin.lembaga.index')
            ->with('success', 'Lembaga desa berhasil ditambahkan.');
    }

    public function show(LembagaDesa $lembaga)
    {
        $lembaga->load(['jabatans', 'anggotas.warga', 'anggotas.jabatan', 'dokumens']);
        return view('pages.lembaga.show', compact('lembaga'));
    }

    public function edit(LembagaDesa $lembaga)
    {
        $lembaga->loadCount(['anggotas', 'jabatans']);
        $lembaga->load('dokumens');
        return view('pages.lembaga.edit', compact('lembaga'));
    }

    public function update(Request $request, LembagaDesa $lembaga)
    {
        $request->validate([
            'nama_lembaga' => 'required|max:100',
            'deskripsi' => 'required|min:50',
            'kontak' => 'nullable|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dokumen.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,mp4,avi,mov|max:50000',
        ]);

        $data = $request->only(['nama_lembaga', 'deskripsi', 'kontak']);

        // Handle logo removal
        if ($request->has('remove_logo')) {
            if ($lembaga->logo) {
                Storage::disk('public')->delete($lembaga->logo);
                $data['logo'] = null;
            }
        }

        // Handle new logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($lembaga->logo) {
                Storage::disk('public')->delete($lembaga->logo);
            }
            $data['logo'] = $request->file('logo')->store('lembaga_desa/logo', 'public');
        }

        // Update data lembaga
        $lembaga->update($data);

        // Upload dokumen baru
        if ($request->hasFile('dokumen')) {
            $this->uploadMultipleDokumen($request->file('dokumen'), $lembaga->id);
        }

        return redirect()->route('admin.lembaga.index')
            ->with('success', 'Lembaga desa berhasil diperbarui.');
    }

    public function destroy(LembagaDesa $lembaga)
    {
        // Hapus logo jika ada
        if ($lembaga->logo) {
            Storage::disk('public')->delete($lembaga->logo);
        }

        // Hapus semua dokumen terkait
        foreach ($lembaga->dokumens as $dokumen) {
            Storage::disk('public')->delete($dokumen->path_file);
            $dokumen->delete();
        }

        $lembaga->delete();

        return redirect()->route('admin.lembaga.index')
            ->with('success', 'Lembaga desa berhasil dihapus.');
    }

    // Method untuk hapus dokumen
    public function hapusDokumen(LembagaDesa $lembaga, $id)
    {
        $dokumen = DokumenLembaga::where('lembaga_id', $lembaga->id)
            ->where('id', $id)
            ->firstOrFail();

        // Hapus file dari storage
        Storage::disk('public')->delete($dokumen->path_file);

        // Hapus dari database
        $dokumen->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }

    // Method untuk download dokumen
    public function downloadDokumen(LembagaDesa $lembaga, $id)
    {
        $dokumen = DokumenLembaga::where('lembaga_id', $lembaga->id)
            ->where('id', $id)
            ->firstOrFail();

        $path = storage_path('app/public/' . $dokumen->path_file);

        if (!file_exists($path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download($path, $dokumen->nama_file);
    }

    // Method untuk menampilkan file (view in browser)
    public function showFile(LembagaDesa $lembaga, $id)
    {
        $dokumen = DokumenLembaga::where('lembaga_id', $lembaga->id)
            ->where('id', $id)
            ->firstOrFail();

        $path = storage_path('app/public/' . $dokumen->path_file);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $mimeType = mime_content_type($path);

        // Untuk file yang bisa ditampilkan di browser
        $viewableMimes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'application/pdf',
            'text/plain',
            'text/html',
            'text/css',
            'text/javascript',
            'application/json',
            'video/mp4',
            'video/webm',
            'video/ogg'
        ];

        if (in_array($mimeType, $viewableMimes)) {
            return response()->file($path, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . $dokumen->nama_file . '"'
            ]);
        }

        // Untuk file yang tidak bisa ditampilkan, langsung download
        return response()->download($path, $dokumen->nama_file);
    }

    // ==================== HELPER METHODS ====================

    /**
     * Upload multiple dokumen
     */
    private function uploadMultipleDokumen($files, $lembagaId)
    {
        foreach ($files as $file) {
            // Simpan file
            $path = $file->store('lembaga_desa/dokumen/' . $lembagaId, 'public');

            // Tentukan tipe file
            $tipe_file = $this->getFileType($file->getClientOriginalExtension());

            // Format ukuran file
            $ukuran_file = $this->formatBytes($file->getSize());

            // Simpan ke database
            DokumenLembaga::create([
                'lembaga_id' => $lembagaId,
                'nama_file' => $file->getClientOriginalName(),
                'path_file' => $path,
                'tipe_file' => $tipe_file,
                'ukuran_file' => $ukuran_file,
                'mime_type' => $file->getMimeType(),
            ]);
        }
    }

    /**
     * Mendapatkan tipe file berdasarkan ekstensi
     */
    private function getFileType($extension)
    {
        $extension = strtolower($extension);

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        $documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv'];
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm'];

        if (in_array($extension, $imageExtensions)) {
            return 'image';
        } elseif (in_array($extension, $documentExtensions)) {
            return 'document';
        } elseif (in_array($extension, $videoExtensions)) {
            return 'video';
        }

        return 'other';
    }

    /**
     * Format ukuran file ke KB/MB
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Get file details for preview
     */
    public function getFileDetails($id)
    {
        $dokumen = DokumenLembaga::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $dokumen->id,
                'nama_file' => $dokumen->nama_file,
                'tipe_file' => $dokumen->tipe_file,
                'ukuran_file' => $dokumen->ukuran_file,
                'url_view' => route('admin.lembaga.dokumen.show', [
                    'lembaga' => $dokumen->lembaga_id,
                    'id' => $dokumen->id
                ]),
                'url_download' => route('admin.lembaga.dokumen.download', [
                    'lembaga' => $dokumen->lembaga_id,
                    'id' => $dokumen->id
                ])
            ]
        ]);
    }
    // Tambahkan method ini di LembagaDesaController
    public function getFileDetailsApi($id)
    {
        $dokumen = DokumenLembaga::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $dokumen->id,
                'nama_file' => $dokumen->nama_file,
                'tipe_file' => $dokumen->tipe_file,
                'ukuran_file' => $dokumen->ukuran_file,
                'url_view' => route('admin.lembaga.dokumen.show', [
                    'lembaga' => $dokumen->lembaga_id,
                    'id' => $dokumen->id
                ]),
                'url_download' => route('admin.lembaga.dokumen.download', [
                    'lembaga' => $dokumen->lembaga_id,
                    'id' => $dokumen->id
                ])
            ]
        ]);
    }
}
