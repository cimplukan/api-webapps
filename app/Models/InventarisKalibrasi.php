<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventarisKalibrasi extends Model
{
    protected $table = 'inventaris_kalibrasi';
    protected $primaryKey = 'id_inventaris_kalibrasi';
    protected $keyType = 'string';

    public function inventaris(): BelongsTo
    {
        return $this->belongsTo(Inventaris::class, 'no_inventaris', 'no_inventaris');
    }
}
