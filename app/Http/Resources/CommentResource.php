<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position,
            'title' => $this->title,
            'comment' => $this->comment,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d.m.Y')
        ];
    }
} 