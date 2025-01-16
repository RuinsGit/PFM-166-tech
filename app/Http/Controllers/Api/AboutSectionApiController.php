<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutSectionResource;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutSectionApiController extends Controller
{
    public function index()
    {
        $aboutSections = AboutSection::all();
        return AboutSectionResource::collection($aboutSections);
    }

    public function show($id)
    {
        try {
            $aboutSection = AboutSection::findOrFail($id);
            return new AboutSectionResource($aboutSection);
        } catch (\Exception $e) {
            return response()->json(['message' => 'About Section not found'], 404);
        }
    }

    public function getByKey($key)
    {
        $aboutSection = AboutSection::where('key', $key)->first();
        
        if (!$aboutSection) {
            return response()->json(['message' => 'About Section not found'], 404);
        }
        
        return new AboutSectionResource($aboutSection);
    }

    public function getByGroup($group)
    {
        $aboutSections = AboutSection::where('group', $group)->get();
        
        if ($aboutSections->isEmpty()) {
            return response()->json(['message' => 'No About Sections found for this group'], 404);
        }
        
        return AboutSectionResource::collection($aboutSections);
    }
} 