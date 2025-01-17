<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'email' => $this->email,
            'email_text' => $this->email_text,
            'application_deadline' => $this->application_deadline,
            'view_count' => $this->view_count,
            'created_at' => $this->created_at->format('d.m.Y')
        ];
    }
} 