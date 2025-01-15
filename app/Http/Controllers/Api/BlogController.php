<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('blogType')
            ->orderBy('id', 'desc')
            ->get();
        
        return BlogResource::collection($blogs);
    }

    public function show($id)
    {
        try {
            $blog = Blog::with('blogType')->findOrFail($id);
            return new BlogResource($blog);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Blog not found'], 404);
        }
    }
} 