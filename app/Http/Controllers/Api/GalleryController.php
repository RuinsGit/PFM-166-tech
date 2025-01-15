<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('galleryType')
            ->orderBy('id', 'desc')
            ->get();
        
        return GalleryResource::collection($galleries);
    }

    public function show($id)
    {
        try {
            $gallery = Gallery::with('galleryType')->findOrFail($id);
            return new GalleryResource($gallery);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gallery not found'], 404);
        }
    }
} 