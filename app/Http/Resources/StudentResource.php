<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'nim'          => $this->nim,
            'nama_lengkap' => $this->nama_lengkap,
            'prodi'        => $this->prodi,
            'angkatan'     => (int) $this->angkatan,
            'email'        => $this->email,
            'alamat'       => $this->alamat,
            'created_at'   => $this->created_at?->toIso8601String(),
            'updated_at'   => $this->updated_at?->toIso8601String(),
        ];
    }
}