<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->get();
        return ServiceResource::collection($services);
    }

    public function show($id)
    {
        try {
            $service = Service::findOrFail($id);
            return new ServiceResource($service);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Service not found'], 404);
        }
    }
} 