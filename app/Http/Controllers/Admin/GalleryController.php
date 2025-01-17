<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryType;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private $destinationPath;

    public function __construct()
    {
        $this->destinationPath = public_path('uploads');
    }

    public function index()
    {
        $galleries = Gallery::all();
        return view('back.pages.gallery.index', compact('galleries'));
    }

    public function create()
    {
        $galleryTypes = GalleryType::where('status', 1)->get();
        return view('back.pages.gallery.create', compact('galleryTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,webp,avif,gif',
            'main_image_alt_az' => 'required|string|max:255',
            'main_image_alt_en' => 'required|string|max:255',
            'main_image_alt_ru' => 'required|string|max:255',
            'bottom_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,gif',
            'bottom_images_alt_az.*' => 'nullable|string|max:255',
            'bottom_images_alt_en.*' => 'nullable|string|max:255',
            'bottom_images_alt_ru.*' => 'nullable|string|max:255',
            'meta_title_az' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
            'gallery_type_id' => 'required|exists:gallery_types,id',
        ]);

        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $this->destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['main_image'] = 'uploads/' . $webpFileName;
            }
        }

        if ($request->hasFile('bottom_images')) {
            $bottomImages = [];
            $bottomImagesAltAz = [];
            $bottomImagesAltEn = [];
            $bottomImagesAltRu = [];

            foreach ($request->file('bottom_images') as $key => $file) {
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $this->destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $bottomImages[] = 'uploads/' . $webpFileName;
                    $bottomImagesAltAz[] = $request->bottom_images_alt_az[$key] ?? '';
                    $bottomImagesAltEn[] = $request->bottom_images_alt_en[$key] ?? '';
                    $bottomImagesAltRu[] = $request->bottom_images_alt_ru[$key] ?? '';
                }
            }
            
            $data['bottom_images'] = json_encode($bottomImages);
            $data['bottom_images_alt_az'] = json_encode($bottomImagesAltAz);
            $data['bottom_images_alt_en'] = json_encode($bottomImagesAltEn);
            $data['bottom_images_alt_ru'] = json_encode($bottomImagesAltRu);
        }

        Gallery::create($data);

        return redirect()->route('back.pages.galleries.index')->with('success', 'Qalereya uğurla yaradıldı.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $galleryTypes = GalleryType::where('status', 1)->get();
        return view('back.pages.gallery.edit', compact('gallery', 'galleryTypes'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,gif',
            'main_image_alt_az' => 'required|string|max:255',
            'main_image_alt_en' => 'required|string|max:255',
            'main_image_alt_ru' => 'required|string|max:255',
            'bottom_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,gif',
            'bottom_images_alt_az.*' => 'nullable|string|max:255',
            'bottom_images_alt_en.*' => 'nullable|string|max:255',
            'bottom_images_alt_ru.*' => 'nullable|string|max:255',
            'meta_title_az' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
            'gallery_type_id' => 'required|exists:gallery_types,id',
        ]);

        if ($request->hasFile('main_image')) {
            if ($gallery->main_image) {
                $oldImagePath = public_path($gallery->main_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('main_image');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $this->destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['main_image'] = 'uploads/' . $webpFileName;
            }
        }

        if ($request->hasFile('bottom_images')) {
            if ($gallery->bottom_images) {
                $oldImages = json_decode($gallery->bottom_images);
                foreach ($oldImages as $oldImage) {
                    $oldImagePath = public_path($oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

            $bottomImages = [];
            $bottomImagesAltAz = [];
            $bottomImagesAltEn = [];
            $bottomImagesAltRu = [];

            foreach ($request->file('bottom_images') as $key => $file) {
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $this->destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $bottomImages[] = 'uploads/' . $webpFileName;
                    $bottomImagesAltAz[] = $request->bottom_images_alt_az[$key] ?? '';
                    $bottomImagesAltEn[] = $request->bottom_images_alt_en[$key] ?? '';
                    $bottomImagesAltRu[] = $request->bottom_images_alt_ru[$key] ?? '';
                }
            }
            
            $data['bottom_images'] = json_encode($bottomImages);
            $data['bottom_images_alt_az'] = json_encode($bottomImagesAltAz);
            $data['bottom_images_alt_en'] = json_encode($bottomImagesAltEn);
            $data['bottom_images_alt_ru'] = json_encode($bottomImagesAltRu);
        }

        $gallery->update($data);

        return redirect()->route('back.pages.galleries.index')->with('success', 'Qalereya uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // Resimleri sil
        if ($gallery->main_image) {
            $mainImagePath = public_path($gallery->main_image);
            if (file_exists($mainImagePath)) {
                unlink($mainImagePath);
            }
        }

        if ($gallery->bottom_images) {
            $bottomImages = json_decode($gallery->bottom_images);
            foreach ($bottomImages as $image) {
                $imagePath = public_path($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $gallery->delete();

        return redirect()->route('back.pages.galleries.index')->with('success', 'Qalereya uğurla silindi.');
    }
}