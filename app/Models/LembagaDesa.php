<?php

namespace App\Models;

use App\Models\AnggotaLembaga;
use App\Models\JabatanLembaga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desas'; // pastikan sesuai dengan nama tabel
    protected $fillable = [
        'nama_lembaga',
        'deskripsi',
        'kontak',
        'logo',
        'status'
    ];

    // Relationship dengan dokumen
    public function dokumens()
    {
        return $this->hasMany(DokumenLembaga::class, 'lembaga_id');
    }

    // Relationship dengan jabatan
    public function jabatans()
    {
        return $this->hasMany(JabatanLembaga::class, 'lembaga_id');
    }

    // Relationship dengan anggota
    public function anggotas()
    {
        return $this->hasMany(AnggotaLembaga::class, 'lembaga_id');
    }

    // Count relations
    public function getJabatansCountAttribute()
    {
        return $this->jabatans()->count();
    }

    public function getAnggotasCountAttribute()
    {
        return $this->anggotas()->count();
    }
}
