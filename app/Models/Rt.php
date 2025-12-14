<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'rw_id',
        'nomor_rt',
        'nama_ketua_rt',
        'kontak_rt',
        'alamat_rt',
        'status'
    ];

    // Relasi dengan RW
    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }

    // Relasi dengan Warga
    public function wargas()
    {
        return $this->hasMany(Warga::class, 'rt_id', 'id');
    }

    // Scope active
    public function scopeActive($query)
    {
        return $query->where('status', 'Aktif');
    }

    // Accessor untuk nomor RT dengan format
    public function getNomorRtFormattedAttribute()
    {
        return 'RT ' . str_pad($this->nomor_rt, 3, '0', STR_PAD_LEFT);
    }

    // Accessor untuk nama lengkap dengan RW
    public function getNamaLengkapAttribute()
    {
        return $this->nomor_rt_formatted . ' - ' . $this->rw->nomor_rw_formatted;
    }
}
