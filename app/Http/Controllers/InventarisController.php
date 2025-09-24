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
        $inventaris = Inventaris::with(['inventarisBarang', 'inventarisRuang'])->find($id);

        if (!$inventaris) {
            return response()->json(['message' => 'Data not found'], 404);
        }

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

        if ($inventaris->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json(InventarisResource::collection($inventaris), 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
