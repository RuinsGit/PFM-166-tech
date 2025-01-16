<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaderResource;
use App\Models\Leader;
use Illuminate\Http\Request;

class LeaderApiController extends Controller
{
    public function index()
    {
        $leaders = Leader::latest()->get();
        return LeaderResource::collection($leaders);
    }

    public function show($id)
    {
        try {
            $leader = Leader::findOrFail($id);
            return new LeaderResource($leader);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Leader not found'], 404);
        }
    }

    public function getByKey($key)
    {
        $leader = Leader::where('key', $key)->first();
        
        if (!$leader) {
            return response()->json(['message' => 'Leader not found'], 404);
        }
        
        return new LeaderResource($leader);
    }

    public function getByStatus($status)
    {
        $leaders = Leader::where('status', $status)->get();
        
        if ($leaders->isEmpty()) {
            return response()->json(['message' => 'No leaders found for this status'], 404);
        }
        
        return LeaderResource::collection($leaders);
    }
} 