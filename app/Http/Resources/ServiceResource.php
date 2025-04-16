<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? asset($this->image) : null,
            'image_alt' => $this->{'image_alt_' . app()->getLocale()},
            'bottom_image' => $this->bottom_image ? asset($this->bottom_image) : null,
            'bottom_image_alt' => $this->{'bottom_image_alt_' . app()->getLocale()},
            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image' => asset($image->image),
                    'alt' => $image->{'alt_' . app()->getLocale()},
                ];  
            }),
            
            
            'meta_title' => $this->{'meta_title_' . app()->getLocale()},
            'meta_description' => $this->{'meta_description_' . app()->getLocale()},
            'title1' => $this->{'title1_' . app()->getLocale()},
            'text1' => $this->{'text1_' . app()->getLocale()},
            'title2' => $this->{'title2_' . app()->getLocale()},
            'text2' => $this->{'text2_' . app()->getLocale()}
        ];
    }
} 