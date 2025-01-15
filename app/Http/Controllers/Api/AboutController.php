<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        
        if (!$about) {
            return response()->json(['message' => 'About not found'], 404);
        }
        
        return new AboutResource($about);
    }

    public function show($id)
    {
        try {
            $about = About::findOrFail($id);
            return new AboutResource($about);
        } catch (\Exception $e) {
            return response()->json(['message' => 'About not found'], 404);
        }
    }
}
