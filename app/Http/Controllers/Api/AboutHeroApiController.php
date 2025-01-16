<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutHeroResource;
use App\Models\AboutHero;
use Illuminate\Http\Request;

class AboutHeroApiController extends Controller
{
    public function index()
    {
        $aboutHero = AboutHero::first();
        if (!$aboutHero) {
            return response()->json(['message' => 'About Hero not found'], 404);
        }
        return new AboutHeroResource($aboutHero);
    }

    public function show($id)
    {
        try {
            $aboutHero = AboutHero::findOrFail($id);
            return new AboutHeroResource($aboutHero);
        } catch (\Exception $e) {
            return response()->json(['message' => 'About Hero not found'], 404);
        }
    }

    public function getByKey($key)
    {
        $aboutHero = AboutHero::where('key', $key)->first();
        
        if (!$aboutHero) {
            return response()->json(['message' => 'About Hero not found'], 404);
        }
        
        return new AboutHeroResource($aboutHero);
    }

    public function getByGroup($group)
    {
        $aboutHeros = AboutHero::where('group', $group)->get();
        
        if ($aboutHeros->isEmpty()) {
            return response()->json(['message' => 'No About Heroes found for this group'], 404);
        }
        
        return AboutHeroResource::collection($aboutHeros);
    }
} 