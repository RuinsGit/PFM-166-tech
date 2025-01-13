<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioType;
use Illuminate\Http\Request;

class PortfolioTypeController extends Controller
{
    public function index()
    {
        $portfolioTypes = PortfolioType::all();
        return view('back.pages.portfolio_type.index', compact('portfolioTypes'));
    }

    public function create()
    {
        return view('back.pages.portfolio_type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        PortfolioType::create($request->all());

        return redirect()->route('back.pages.portfolio_type.index')->with('success', 'Portfolio type uğurla yaradıldı.');
    }

    public function edit($id)
    {
        $portfolioType = PortfolioType::findOrFail($id);
        return view('back.pages.portfolio_type.edit', compact('portfolioType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $portfolioType = PortfolioType::findOrFail($id);
        $portfolioType->update($request->all());

        return redirect()->route('back.pages.portfolio_type.index')->with('success', 'Portfolio type uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $portfolioType = PortfolioType::findOrFail($id);
        $portfolioType->delete();

        return redirect()->route('back.pages.portfolio_type.index')->with('success', 'Portfolio type uğurla silindi.');
    }
} 