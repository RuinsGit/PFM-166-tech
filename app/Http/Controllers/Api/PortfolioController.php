<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('portfolioType')
            ->orderBy('id', 'desc')
            ->get();
        
        return PortfolioResource::collection($portfolios);
    }

    public function show($id)
    {
        try {
            $portfolio = Portfolio::with('portfolioType')->findOrFail($id);
            return new PortfolioResource($portfolio);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Portfolio not found'], 404);
        }
    }
} 