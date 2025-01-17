<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KeyfiyetResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            [
                'count' => $this->number_filial,
                'title' => $this->filial_title,
                'id' => $this->id,
            ],
            [
                'count' => $this->number_customer,
                'title' => $this->customer_title,
                'id' => $this->id + 1,
            ],
            [
                'count' => $this->number_keyfiyet,
                'title' => $this->keyfiyet_title,
                'id' => $this->id + 2,
            ]
        ];
    }
} 