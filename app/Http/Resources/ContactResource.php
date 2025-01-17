<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            [
                'value' => $this->number,
                'title' => $this->filial_description,
                'id' => $this->id,
            ],
            [
                'value' => $this->mail,
                'title' => $this->filial_description,
                'id' => $this->id + 1,
            ],
            [
                'value' => $this->address,
                'title' => $this->filial_description,
                'id' => $this->id + 2,
            ]
        ];
    }
} 