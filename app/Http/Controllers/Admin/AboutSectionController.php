<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutSectionController extends Controller
{
    public function index()
    {
        $aboutSections = AboutSection::all();
        return view('back.pages.about-section.index', compact('aboutSections'));
    }

    public function create()
    {
        return view('back.pages.about-section.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about-section'), $imageName);
                $data['image'] = 'uploads/about-section/' . $imageName;
            }

            AboutSection::create($data);

            return redirect()
                ->route('back.pages.about-section.index')
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
        $aboutSection = AboutSection::findOrFail($id);
        return view('back.pages.about-section.edit', compact('aboutSection'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
        ]);

        try {
            $aboutSection = AboutSection::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('image')) {
                // Eski resmi sil
                if ($aboutSection->image && File::exists(public_path($aboutSection->image))) {
                    File::delete(public_path($aboutSection->image));
                }

                // Yeni resmi yükle
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about-section'), $imageName);
                $data['image'] = 'uploads/about-section/' . $imageName;
            }

            $aboutSection->update($data);

            return redirect()
                ->route('back.pages.about-section.index')
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
            $aboutSection = AboutSection::findOrFail($id);

            if ($aboutSection->image && File::exists(public_path($aboutSection->image))) {
                File::delete(public_path($aboutSection->image));
            }

            $aboutSection->delete();

            return redirect()
                ->route('back.pages.about-section.index')
                ->with('success', 'Məlumatlar uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
