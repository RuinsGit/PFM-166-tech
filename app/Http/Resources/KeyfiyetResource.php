<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KeyfiyetResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number_filial' => $this->number_filial,
            'number_customer' => $this->number_customer,
            'number_keyfiyet' => $this->number_keyfiyet,
            'filial_title' => $this->filial_title,
            'customer_title' => $this->customer_title,
            'keyfiyet_title' => $this->keyfiyet_title,
        ];
    }
} 