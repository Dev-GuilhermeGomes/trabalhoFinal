<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'release_date' => $this->release_date,
            'genre' => $this->genre,
            'pegi' => $this->pegi,
            'platform' => $this->platform,
            'studio' => $this->studio->name,
        ];
    }
}