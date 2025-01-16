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
                'number' => $this->number,
                'number_image' => asset($this->number_image),
                'id' => $this->id,
            ],
            [
                'mail' => $this->mail,
                'mail_image' => asset($this->mail_image),
                'id' => $this->id,
            ],
             [
                'address' => $this->address,
                'address_image' => asset($this->address_image),
                'id' => $this->id,
            ],
            'filial_description' => $this->filial_description,
            'id' => $this->id,
        ];
    }
} 