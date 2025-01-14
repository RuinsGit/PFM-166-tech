<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryType;
use Illuminate\Http\Request;

class GalleryTypeController extends Controller
{
    public function index()
    {
        $galleryTypes = GalleryType::all();
        return view('back.pages.gallery_type.index', compact('galleryTypes'));
    }

    public function create()
    {
        return view('back.pages.gallery_type.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        GalleryType::create($data);

        return redirect()->route('back.pages.gallery_type.index')->with('success', 'Galeri tipi başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $galleryType = GalleryType::findOrFail($id);
        return view('back.pages.gallery_type.edit', compact('galleryType'));
    }

    public function update(Request $request, $id)
    {
        $galleryType = GalleryType::findOrFail($id);

        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $galleryType->update($data);

        return redirect()->route('back.pages.gallery_type.index')->with('success', 'Galeri tipi başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $galleryType = GalleryType::findOrFail($id);
        $galleryType->delete();

        return redirect()->route('back.pages.gallery_type.index')->with('success', 'Galeri tipi başarıyla silindi.');
    }
} 