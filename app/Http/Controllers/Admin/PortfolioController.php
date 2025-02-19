<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioType;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private $destinationPath;

    public function __construct()
    {
        $this->destinationPath = public_path('uploads');
    }

    public function index()
    {
        $portfolios = Portfolio::all();
        return view('back.pages.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $portfolioTypes = PortfolioType::where('status', 1)->get();
        return view('back.pages.portfolio.create', compact('portfolioTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg',
            'main_image_alt_az' => 'required|string|max:255',
            'main_image_alt_en' => 'required|string|max:255',
            'main_image_alt_ru' => 'required|string|max:255',
            'bottom_images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'bottom_images_alt_az.*' => 'nullable|string|max:255',
            'bottom_images_alt_en.*' => 'nullable|string|max:255',
            'bottom_images_alt_ru.*' => 'nullable|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'meta_title_az' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
            'portfolio_type_id' => 'required|exists:portfolio_types,id',
        ]);

        // Ana resmi yükle
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

        // Alt resimleri yükle
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
                    
                    // Store corresponding ALT texts
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

        // Portfolio oluştur
        Portfolio::create($data);

        return redirect()->route('back.pages.portfolio.index')->with('success', 'Portfolio uğurla yaradıldı.');
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolioTypes = PortfolioType::where('status', 1)->get();
        return view('back.pages.portfolio.edit', compact('portfolio', 'portfolioTypes'));
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg',
            'main_image_alt_az' => 'required|string|max:255',
            'main_image_alt_en' => 'required|string|max:255',
            'main_image_alt_ru' => 'required|string|max:255',
            'bottom_images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'bottom_images_alt_az.*' => 'nullable|string|max:255',
            'bottom_images_alt_en.*' => 'nullable|string|max:255',
            'bottom_images_alt_ru.*' => 'nullable|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'meta_title_az' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
            'portfolio_type_id' => 'required|exists:portfolio_types,id',
            'existing_bottom_images.*' => 'nullable|string',
        ]);

        // Ana resmi güncelle
        if ($request->hasFile('main_image')) {
            // Eski resmi sil
            if ($portfolio->main_image) {
                $oldImagePath = public_path($portfolio->main_image);
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

        // Alt resimleri güncelle
        $existingImages = $request->input('existing_bottom_images', []);
        $newBottomImages = [];
        $newBottomImagesAltAz = [];
        $newBottomImagesAltEn = [];
        $newBottomImagesAltRu = [];

        // Mevcut resimleri işle
        foreach ($existingImages as $index => $image) {
            if(isset($request->bottom_images_alt_az[$index])) {
                $newBottomImages[] = $image;
                $newBottomImagesAltAz[] = $request->bottom_images_alt_az[$index] ?? '';
                $newBottomImagesAltEn[] = $request->bottom_images_alt_en[$index] ?? '';
                $newBottomImagesAltRu[] = $request->bottom_images_alt_ru[$index] ?? '';
            }
        }

        // Yeni resimleri ekle
        if ($request->hasFile('bottom_images')) {
            foreach ($request->file('bottom_images') as $key => $file) {
                if($file->isValid()) {
                    $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $webpFileName = time() . '_' . $originalFileName . '.webp';

                    $imageResource = imagecreatefromstring(file_get_contents($file));
                    $webpPath = $this->destinationPath . '/' . $webpFileName;

                    if ($imageResource) {
                        imagewebp($imageResource, $webpPath, 80);
                        imagedestroy($imageResource);

                        $newBottomImages[] = 'uploads/' . $webpFileName;
                        
                        // Yeni ALT metinlerini ekle
                        $newBottomImagesAltAz[] = $request->bottom_images_alt_az[count($existingImages) + $key] ?? '';
                        $newBottomImagesAltEn[] = $request->bottom_images_alt_en[count($existingImages) + $key] ?? '';
                        $newBottomImagesAltRu[] = $request->bottom_images_alt_ru[count($existingImages) + $key] ?? '';
                    }
                }
            }
        }

        // Silinen resimleri kaldır
        if ($portfolio->bottom_images) {
            $oldImages = json_decode($portfolio->bottom_images);
            foreach ($oldImages as $oldImage) {
                if(!in_array($oldImage, $newBottomImages)) {
                    $oldImagePath = public_path($oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
        }

        // Verileri güncelle
        $data['bottom_images'] = json_encode($newBottomImages);
        $data['bottom_images_alt_az'] = json_encode($newBottomImagesAltAz);
        $data['bottom_images_alt_en'] = json_encode($newBottomImagesAltEn);
        $data['bottom_images_alt_ru'] = json_encode($newBottomImagesAltRu);

        // Portfolio güncelle
        $portfolio->update($data);

        return redirect()->route('back.pages.portfolio.index')->with('success', 'Portfolio uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        
        // Resimleri sil
        if ($portfolio->main_image) {
            $mainImagePath = public_path($portfolio->main_image);
            if (file_exists($mainImagePath)) {
                unlink($mainImagePath);
            }
        }

        if ($portfolio->bottom_images) {
            $bottomImages = json_decode($portfolio->bottom_images);
            foreach ($bottomImages as $image) {
                $imagePath = public_path($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $portfolio->delete();

        return redirect()->route('back.pages.portfolio.index')->with('success', 'Portfolio uğurla silindi.');
    }
} 