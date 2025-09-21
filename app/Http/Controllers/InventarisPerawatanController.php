<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventarisPerawatanCreateRequest;
use App\Http\Resources\InventarisPerawatanCollection;
use App\Http\Resources\InventarisPerawatanResource;
use App\Models\Inventaris;
use App\Models\InventarisPerawatan;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InventarisPerawatanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(InventarisPerawatanCreateRequest $request)
    {
        $data = $request->validated();

        $perawatan = new InventarisPerawatan($data);
        $perawatan->id_inventaris_perawatan = $data['id']; // Use 'id' from request if provided
        $perawatan->no_inventaris = $data['no_inventaris'];
        $perawatan->nip = $data['nip']; // Use 'nip' from request if provided
        $perawatan->save();

        $perawatan = InventarisPerawatan::with(["inventaris.inventarisBarang", "inventaris.inventarisRuang", "petugas"])
            ->find($perawatan->id_inventaris_perawatan);
        return response()->json(new InventarisPerawatanResource($perawatan), 201, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perawatan = InventarisPerawatan::with(["inventaris.inventarisBarang", "inventaris.inventarisRuang", "petugas"])->find($id);
        if (!$perawatan) {
            return response()->json(['message' => 'not found'], 404);
        }

        return response()->json(new InventarisPerawatanResource($perawatan), 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource by Inventaris.
     */
    public function showByInventaris(string $id)
    {
        $perawatan = InventarisPerawatan::with(["inventaris.inventarisBarang", "inventaris.inventarisRuang", "petugas"])
            ->where('no_inventaris', $id)
            ->get();
        if ($perawatan->isEmpty()) {
            return response()->json(['message' => 'not found'], 404);
        }

        return response()->json(new InventarisPerawatanCollection($perawatan), 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource by Ruang.
     */
    public function showByRuang(string $id, Request $request)
    {
        // Validate the 'bulan' parameter if it exists
        if ($request->has('bulan')) {
            if (!preg_match('/^\d{4}-\d{2}$/', $request->input('bulan'))) {
                return response()->json(['message' => 'Invalid month format. Use YYYY-MM.'], 400);
            }
        } else {
            return response()->json(['message' => 'Bulan parameter is required.'], 400);
        }

        // Fetch perawatan records for the specified ruang
        $perawatan = InventarisPerawatan::query()
            ->whereHas('inventaris', function (Builder $query) use ($id) {
                $query->where('id_ruang', $id);
            });
        $perawatan = $perawatan->when($request->has('bulan'), function (Builder $query) use ($request) {
            $query->where('tanggal', 'like', $request->input('bulan') . '%');
        });
        $perawatan = $perawatan->with(['inventaris.inventarisBarang', 'inventaris.inventarisRuang'])
            ->get();

        if ($perawatan->isEmpty()) {
            return response()->json(['message' => 'not found'], 404);
        }

        return response()->json(new InventarisPerawatanCollection($perawatan), 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
