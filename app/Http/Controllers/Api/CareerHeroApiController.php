<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CareerHeroResource;
use App\Models\CareerHero;
use Illuminate\Http\Request;

class CareerHeroApiController extends Controller
{
    public function index()
    {
        $careerHero = CareerHero::first();
        if (!$careerHero) {
            return response()->json(['message' => 'Career Hero not found'], 404);
        }
        return new CareerHeroResource($careerHero);
    }

    public function show($id)
    {
        try {
            $careerHero = CareerHero::findOrFail($id);
            return new CareerHeroResource($careerHero);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Career Hero not found'], 404);
        }
    }

    public function getByKey($key)
    {
        $careerHero = CareerHero::where('key', $key)->first();
        
        if (!$careerHero) {
            return response()->json(['message' => 'Career Hero not found'], 404);
        }
        
        return new CareerHeroResource($careerHero);
    }

    public function getByGroup($group)
    {
        $careerHeros = CareerHero::where('group', $group)->get();
        
        if ($careerHeros->isEmpty()) {
            return response()->json(['message' => 'No Career Heroes found for this group'], 404);
        }
        
        return CareerHeroResource::collection($careerHeros);
    }
} 