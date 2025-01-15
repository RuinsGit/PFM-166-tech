<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $images = [];
        if ($this->bottom_images) {
            $bottomImages = json_decode($this->bottom_images, true);
            $bottomImagesAlt = json_decode($this->{'bottom_images_alt_' . app()->getLocale()}, true) ?? [];
            
            foreach ($bottomImages as $index => $image) {
                $images[] = [
                    'id' => $index + 1,
                    'image' => asset($image),
                    'image_alt' => $bottomImagesAlt[$index] ?? null
                ];
            }
        }

        return [
            'id' => $this->id,
            'title' => $this->{'title_' . app()->getLocale()},
            'main_image' => $this->main_image ? asset($this->main_image) : null,
            'main_image_alt' => $this->{'main_image_alt_' . app()->getLocale()},
            'images' => $images,
            'description' => $this->{'description_' . app()->getLocale()},
            'meta_title' => $this->{'meta_title_' . app()->getLocale()},
            'meta_description' => $this->{'meta_description_' . app()->getLocale()},
            'portfolio_type' => new PortfolioTypeResource($this->whenLoaded('portfolioType'))
        ];
    }
} 