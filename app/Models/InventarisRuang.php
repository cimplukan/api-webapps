<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventarisRuang extends Model
{
    protected $table = 'inventaris_ruang';
    protected $primaryKey = 'id_ruang';
    protected $keyType = 'string';

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class, 'id_ruang', 'id_ruang');
    }
}
