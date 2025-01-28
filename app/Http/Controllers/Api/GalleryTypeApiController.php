<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryTypeResource;
use App\Models\GalleryType;
use Illuminate\Http\Request;

class GalleryTypeApiController extends Controller
{
    public function index()
    {
        $galleryTypes = GalleryType::where('status', 1)->get();
        return GalleryTypeResource::collection($galleryTypes);
    }

    public function show($id)
    {
        $galleryType = GalleryType::findOrFail($id);
        return new GalleryTypeResource($galleryType);
    }
} 