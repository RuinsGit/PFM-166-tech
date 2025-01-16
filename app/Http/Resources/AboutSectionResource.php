<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutSectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'image' => $this->image ? asset($this->image) : null,
            'image_alt' => $this->image_alt,
        ];
    }
} 