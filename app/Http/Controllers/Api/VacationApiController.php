<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VacationResource;
use App\Models\Vacation;
use Illuminate\Http\Request;

class VacationApiController extends Controller
{
    public function index()
    {
        $vacations = Vacation::all();
        if ($vacations->isEmpty()) {
            return response()->json(['message' => 'No Vacations found'], 404);
        }
        return VacationResource::collection($vacations);
    }

    public function show($id)
    {
        try {
            $vacation = Vacation::findOrFail($id);
            return new VacationResource($vacation);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Vacation not found'], 404);
        }
    }

    public function getByKey($key)
    {
        $vacation = Vacation::where('key', $key)->first();
        
        if (!$vacation) {
            return response()->json(['message' => 'Vacation not found'], 404);
        }
        
        return new VacationResource($vacation);
    }

    public function getByGroup($group)
    {
        $vacations = Vacation::where('group', $group)->get();
        
        if ($vacations->isEmpty()) {
            return response()->json(['message' => 'No Vacations found for this group'], 404);
        }
        
        return VacationResource::collection($vacations);
    }
} 