<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenLembaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'lembaga_id',
        'nama_file',
        'path_file',
        'tipe_file',
        'ukuran_file',
        'mime_type'
    ];

    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id');
    }

    // Accessor untuk URL file
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->path_file);
    }

    // Accessor untuk path storage
    public function getStoragePathAttribute()
    {
        return storage_path('app/public/' . $this->path_file);
    }

    // Method untuk cek apakah file ada
    public function fileExists()
    {
        return file_exists($this->storage_path);
    }

    // Get icon berdasarkan tipe file
    public function getIconAttribute()
    {
        switch ($this->tipe_file) {
            case 'image':
                return 'fas fa-image text-success';
            case 'document':
                if ($this->mime_type && str_contains($this->mime_type, 'pdf')) {
                    return 'fas fa-file-pdf text-danger';
                }
                if ($this->mime_type && str_contains($this->mime_type, 'word')) {
                    return 'fas fa-file-word text-primary';
                }
                if ($this->mime_type && str_contains($this->mime_type, 'excel')) {
                    return 'fas fa-file-excel text-success';
                }
                return 'fas fa-file-alt text-info';
            case 'video':
                return 'fas fa-file-video text-warning';
            default:
                return 'fas fa-file text-secondary';
        }
    }
}
