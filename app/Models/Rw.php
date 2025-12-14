<?php

namespace App\Models;

use App\Models\Rt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nomor_rw',
        'nama_ketua_rw',
        'kontak_rw',
        'alamat_rw',
        'status'
    ];

    // Relasi dengan RT
    public function rts()
    {
        return $this->hasMany(Rt::class, 'rw_id', 'id');
    }

    // Relasi dengan Warga
    public function wargas()
    {
        return $this->hasMany(Warga::class, 'rw_id', 'id');
    }

    // Scope active
    public function scopeActive($query)
    {
        return $query->where('status', 'Aktif');
    }

    // Accessor untuk nomor RW dengan format
    public function getNomorRwFormattedAttribute()
    {
        return 'RW ' . str_pad($this->nomor_rw, 2, '0', STR_PAD_LEFT);
    }
}
