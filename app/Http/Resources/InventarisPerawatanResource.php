<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventarisPerawatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id_inventaris_perawatan,
            "inventaris" => new InventarisResource($this->whenLoaded('inventaris')),
            "petugas" => new PetugasResource($this->whenLoaded('petugas')),
            "tanggal" => $this->tanggal,
            "kondisi" => $this->kondisi,
            "status" => $this->status,
            "keterangan" => $this->keterangan,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
