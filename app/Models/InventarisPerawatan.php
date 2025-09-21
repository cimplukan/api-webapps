<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventarisPerawatan extends Model
{
    protected $table = 'inventaris_perawatan';
    protected $primaryKey = 'id_inventaris_perawatan';
    protected $keyType = 'string';
    protected $fillable = [
        'tanggal',
        'kondisi',
        'status',
        'keterangan'
    ];
    public $incrementing = false;
    public $timestamps = true;

    public function inventaris(): BelongsTo
    {
        return $this->belongsTo(Inventaris::class, 'no_inventaris', 'no_inventaris');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'nip', 'nip');
    }
}
