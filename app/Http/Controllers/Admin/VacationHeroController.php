<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VacationHero;
use Illuminate\Http\Request;

class VacationHeroController extends Controller
{
    public function index()
    {
        $vacationHeroes = VacationHero::all();
        return view('back.pages.vacation_hero.index', compact('vacationHeroes'));
    }

    public function create()
    {
        return view('back.pages.vacation_hero.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|max:2048', 
            'image_alt_az' => 'required|string|max:255', 
            'image_alt_en' => 'required|string|max:255', 
            'image_alt_ru' => 'required|string|max:255', 
        ]);

        // Resmi yükle
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/vacation_heroes'), $filename);
            $data['image'] = 'uploads/vacation_heroes/' . $filename;
        }

        VacationHero::create($data);

        return redirect()->route('back.pages.vacation_hero.index')->with('success', 'Vacation Hero başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $vacationHero = VacationHero::findOrFail($id);
        return view('back.pages.vacation_hero.edit', compact('vacationHero'));
    }

    public function update(Request $request, $id)
    {
        $vacationHero = VacationHero::findOrFail($id);

        $data = $request->validate([
            'image' => 'nullable|image|max:2048', 
            'image_alt_az' => 'required|string|max:255', 
            'image_alt_en' => 'required|string|max:255', 
            'image_alt_ru' => 'required|string|max:255', 
        ]);

        // Resmi güncelle
        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($vacationHero->image) {
                unlink(public_path($vacationHero->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/vacation_heroes'), $filename);
            $data['image'] = 'uploads/vacation_heroes/' . $filename;
        }

        $vacationHero->update($data);

        return redirect()->route('back.pages.vacation_hero.index')->with('success', 'Vacation Hero başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $vacationHero = VacationHero::findOrFail($id);
        // Resmi sil
        if ($vacationHero->image) {
            unlink(public_path($vacationHero->image));
        }
        $vacationHero->delete();

        return redirect()->route('back.pages.vacation_hero.index')->with('success', 'Vacation Hero başarıyla silindi.');
    }
} 