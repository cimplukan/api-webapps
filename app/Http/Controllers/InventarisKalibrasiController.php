<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventarisKalibrasiCollection;
use App\Http\Resources\InventarisKalibrasiResource;
use App\Models\InventarisKalibrasi;
use Illuminate\Http\Request;

class InventarisKalibrasiController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function showByInventaris(string $id)
    {
        $kalibrasi = InventarisKalibrasi::with(['inventaris', 'inventaris.inventarisBarang', 'inventaris.inventarisRuang'])
            ->where('no_inventaris', $id)
            ->get();
        if ($kalibrasi->isEmpty()) {
            return response()->json(['message' => 'not found'], 404);
        }

        return response()->json(new InventarisKalibrasiCollection($kalibrasi), 200);
    }
}
