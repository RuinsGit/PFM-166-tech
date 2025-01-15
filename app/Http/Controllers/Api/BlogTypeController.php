<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogTypeResource;
use App\Models\BlogType;
use Illuminate\Http\Request;

class BlogTypeController extends Controller
{
    public function index()
    {
        $blogTypes = BlogType::where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
        
        return BlogTypeResource::collection($blogTypes);
    }

    public function show($id)
    {
        try {
            $blogType = BlogType::findOrFail($id);
            return new BlogTypeResource($blogType);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Blog type not found'], 404);
        }
    }
}
