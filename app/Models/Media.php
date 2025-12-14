<?php
// app/Models/Media.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $primaryKey = 'media_id';   // ← WAJIB ADA

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];

    /**
     * Get the full URL for the file
     */
    public function getFileUrlAttribute()
    {
        return $this->file_name ? asset('storage/' . $this->file_name) : null;
    }

    /**
     * Scope for specific table reference
     */
    public function scopeForTable($query, $tableName)
    {
        return $query->where('ref_table', $tableName);
    }
}
