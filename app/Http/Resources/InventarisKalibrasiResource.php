<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventarisKalibrasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_inventaris_kalibrasi,
            'inventaris' => new InventarisResource($this->whenLoaded('inventaris')),
            'no_sertifikat' => $this->no_sertifikat,
            'tgl_kalibrasi' => $this->tgl_kalibrasi,
            'tgl_kadaluarsa' => $this->tgl_kadaluarsa,
            'photo' => $this->photo,
            'link_gdrive' => $this->link_gdrive,
        ];
    }
}
