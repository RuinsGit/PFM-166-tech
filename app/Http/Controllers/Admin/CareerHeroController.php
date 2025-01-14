<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerHero;
use Illuminate\Http\Request;

class CareerHeroController extends Controller
{
    public function index()
    {
        $careerHeroes = CareerHero::all();
        return view('back.pages.career_hero.index', compact('careerHeroes'));
    }

    public function create()
    {
        return view('back.pages.career_hero.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|max:2048', 
            'image_alt_az' => 'required|string|max:255', 
            'image_alt_en' => 'required|string|max:255', 
            'image_alt_ru' => 'required|string|max:255', 
            'description_az' => 'required|string', 
            'description_en' => 'required|string', 
            'description_ru' => 'required|string', 
            'video' => 'required|file|mimes:mp4,avi,mov|', 
        ]);

        // Resmi yükle
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/career_heroes'), $filename);
            $data['image'] = 'uploads/career_heroes/' . $filename;
        }

        // Videoyu yükle
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoFilename = time() . '_video.' . $videoFile->getClientOriginalExtension();
            $videoFile->move(public_path('uploads/career_heroes/videos'), $videoFilename);
            $data['video'] = 'uploads/career_heroes/videos/' . $videoFilename;
        }

        CareerHero::create($data);

        return redirect()->route('back.pages.career_hero.index')->with('success', 'Career Hero başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $careerHero = CareerHero::findOrFail($id);
        return view('back.pages.career_hero.edit', compact('careerHero'));
    }

    public function update(Request $request, $id)
    {
        $careerHero = CareerHero::findOrFail($id);

        $data = $request->validate([
            'image' => 'nullable|image|max:2048', 
            'image_alt_az' => 'required|string|max:255', 
            'image_alt_en' => 'required|string|max:255', 
            'image_alt_ru' => 'required|string|max:255', 
            'description_az' => 'required|string', 
            'description_en' => 'required|string', 
            'description_ru' => 'required|string', 
            'video' => 'nullable|file|mimes:mp4,avi,mov|', 
        ]);

        // Resmi güncelle
        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($careerHero->image) {
                unlink(public_path($careerHero->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/career_heroes'), $filename);
            $data['image'] = 'uploads/career_heroes/' . $filename;
        }

        // Videoyu güncelle
        if ($request->hasFile('video')) {
            // Eski videoyu sil
            if ($careerHero->video) {
                unlink(public_path($careerHero->video));
            }

            $videoFile = $request->file('video');
            $videoFilename = time() . '_video.' . $videoFile->getClientOriginalExtension();
            $videoFile->move(public_path('uploads/career_heroes/videos'), $videoFilename);
            $data['video'] = 'uploads/career_heroes/videos/' . $videoFilename;
        }

        $careerHero->update($data);

        return redirect()->route('back.pages.career_hero.index')->with('success', 'Career Hero başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $careerHero = CareerHero::findOrFail($id);
        // Resmi sil
        if ($careerHero->image) {
            unlink(public_path($careerHero->image));
        }
        // Videoyu sil
        if ($careerHero->video) {
            unlink(public_path($careerHero->video));
        }
        $careerHero->delete();

        return redirect()->route('back.pages.career_hero.index')->with('success', 'Career Hero başarıyla silindi.');
    }
} 