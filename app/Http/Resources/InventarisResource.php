<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventarisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'no_inventaris' => $this->no_inventaris,
            'barang' => new InventarisBarangResource($this->whenLoaded('inventarisBarang')),
            'asal_barang' => $this->asal_barang,
            'tgl_pengadaan' => $this->tgl_pengadaan,
            'harga' => $this->harga,
            'status_barang' => $this->status_barang,
            'ruang' => new InventarisRuangResource($this->whenLoaded('inventarisRuang')),
            'no_rak' => $this->no_rak,
            'no_box' => $this->no_box,
        ];
    }
}
