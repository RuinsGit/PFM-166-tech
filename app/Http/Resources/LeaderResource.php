<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'image' => $this->image ? asset($this->image) : null,
            'position' => $this->position,
            'status' => $this->status,
        ];

        
    }
} 