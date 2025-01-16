<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AcceptanceResource;
use App\Models\Acceptance;
use Illuminate\Http\Request;

class AcceptanceApiController extends Controller
{
    public function index()
    {
        $acceptances = Acceptance::all();
        if ($acceptances->isEmpty()) {
            return response()->json(['message' => 'No Acceptances found'], 404);
        }
        return AcceptanceResource::collection($acceptances);
    }

    public function show($id)
    {
        try {
            $acceptance = Acceptance::findOrFail($id);
            return new AcceptanceResource($acceptance);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Acceptance not found'], 404);
        }
    }

    public function getByKey($key)
    {
        $acceptance = Acceptance::where('key', $key)->first();
        
        if (!$acceptance) {
            return response()->json(['message' => 'Acceptance not found'], 404);
        }
        
        return new AcceptanceResource($acceptance);
    }

    public function getByGroup($group)
    {
        $acceptances = Acceptance::where('group', $group)->get();
        
        if ($acceptances->isEmpty()) {
            return response()->json(['message' => 'No Acceptances found for this group'], 404);
        }
        
        return AcceptanceResource::collection($acceptances);
    }
} 