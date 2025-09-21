<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Http\Resources\InventarisResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class InventarisController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $inventaris = Inventaris::with(['inventarisBarang', 'inventarisRuang'])->findOrFail($id);

        return response()->json(new InventarisResource($inventaris), 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Display a listing of the resource by ruang.
     */
    public function showByRuang(string $id): JsonResponse
    {
        $inventaris = Inventaris::with(['inventarisBarang', 'inventarisRuang'])
            ->where('id_ruang', $id)
            ->get();

        return response()->json(InventarisResource::collection($inventaris), 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
