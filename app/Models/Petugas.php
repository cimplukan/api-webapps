<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';

    public function inventarisPerawatan(): HasMany
    {
        return $this->hasMany(InventarisPerawatan::class, 'nip', 'nip');
    }
}
