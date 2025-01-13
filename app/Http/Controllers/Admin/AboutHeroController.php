<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutHeroController extends Controller
{
    public function index()
    {
        $aboutHero = AboutHero::first();
        return view('back.pages.about-hero.index', compact('aboutHero'));
    }

    public function create()
    {
        return view('back.pages.about-hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'description1_az' => 'required|string',
            'description1_en' => 'nullable|string',
            'description1_ru' => 'nullable|string',
            'description2_az' => 'required|string',
            'description2_en' => 'nullable|string',
            'description2_ru' => 'nullable|string',
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about-hero'), $imageName);
                $data['image'] = 'uploads/about-hero/' . $imageName;
            }

            AboutHero::create($data);

            return redirect()
                ->route('back.pages.about-hero.index')
                ->with('success', 'Məlumatlar uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $aboutHero = AboutHero::findOrFail($id);
        return view('back.pages.about-hero.edit', compact('aboutHero'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'description1_az' => 'required|string',
            'description1_en' => 'nullable|string',
            'description1_ru' => 'nullable|string',
            'description2_az' => 'required|string',
            'description2_en' => 'nullable|string',
            'description2_ru' => 'nullable|string',
        ]);

        try {
            $aboutHero = AboutHero::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('image')) {
                // Eski resmi sil
                if ($aboutHero->image && File::exists(public_path($aboutHero->image))) {
                    File::delete(public_path($aboutHero->image));
                }

                // Yeni resmi yükle
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about-hero'), $imageName);
                $data['image'] = 'uploads/about-hero/' . $imageName;
            }

            $aboutHero->update($data);

            return redirect()
                ->route('back.pages.about-hero.index')
                ->with('success', 'Məlumatlar uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $aboutHero = AboutHero::findOrFail($id);

            if ($aboutHero->image && File::exists(public_path($aboutHero->image))) {
                File::delete(public_path($aboutHero->image));
            }

            $aboutHero->delete();

            return redirect()
                ->route('back.pages.about-hero.index')
                ->with('success', 'Məlumatlar uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
} 