<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventarisBarang extends Model
{
    protected $table = 'inventaris_barang';
    protected $primaryKey = 'kode_barang';
    protected $keyType = 'string';
    public $incrementing = false; // Assuming 'kode_barang' is not an auto-in

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class, 'kode_barang', 'kode_barang');
    }
}
