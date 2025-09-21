<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'no_inventaris';
    protected $keyType = 'string';

    public function inventarisBarang(): BelongsTo
    {
        return $this->belongsTo(InventarisBarang::class, 'kode_barang', 'kode_barang');
    }

    public function inventarisRuang(): BelongsTo
    {
        return $this->belongsTo(InventarisRuang::class, 'id_ruang', 'id_ruang');
    }
}
