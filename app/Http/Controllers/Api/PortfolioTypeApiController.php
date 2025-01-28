<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioTypeResource;
use App\Models\PortfolioType;
use Illuminate\Http\Request;

class PortfolioTypeApiController extends Controller
{
    public function index()
    {
        $portfolioTypes = PortfolioType::where('status', 1)->get();
        return PortfolioTypeResource::collection($portfolioTypes);
    }

    public function show($id)
    {
        $portfolioType = PortfolioType::findOrFail($id);
        return new PortfolioTypeResource($portfolioType);
    }
} 