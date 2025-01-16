<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutHeroResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? asset($this->image) : null,
            'image_alt' => $this->image_alt,
            'description1' => $this->description1,
            'description2' => $this->description2,
        ];
    }
} 