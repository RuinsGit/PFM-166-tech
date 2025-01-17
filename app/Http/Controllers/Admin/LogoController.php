<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LogoController extends Controller
{
    protected $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/svg+xml',
        'image/webp',
        'application/svg+xml',
        'application/svg',
    ];

    protected function handleImageUpload($file, $prefix = '')
    {
        $destinationPath = public_path('uploads/logos');
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // SVG dosyası kontrolü
        if ($file->getClientOriginalExtension() === 'svg') {
            $fileName = time() . '_' . $prefix . '_' . $originalFileName . '.svg';
            $file->move($destinationPath, $fileName);
            return 'uploads/logos/' . $fileName;
        } else {
            // Diğer resim formatları için webp dönüşümü
            $webpFileName = time() . '_' . $prefix . '_' . $originalFileName . '.webp';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);
                return 'uploads/logos/' . $webpFileName;
            }

            throw new \Exception('Resim işlenirken bir hata oluştu.');
        }
    }

    public function index()
    {
        $logos = Logo::all();
        $logoCount = $logos->count();
        return view('back.admin.logos.index', compact('logos', 'logoCount'));
    }

    public function create()
    {
        $logoCount = Logo::count();
        return view('back.admin.logos.create', compact('logoCount'));
    }

    public function store(Request $request)
    {
        $logoCount = Logo::count();

        if ($logoCount >= 1) {
            return redirect()->route('back.pages.logos.index')->with('error', 'Zaten bir logo mevcut. Yeni bir logo ekleyemezsiniz.');
        }

        $request->validate([
            'logo_1_image' => 'required|max:2048',
            'logo_2_image' => 'required|max:2048',
            'logo_alt1_az' => 'required|string',
            'logo_alt1_en' => 'required|string',
            'logo_alt1_ru' => 'required|string',
            'logo_alt2_az' => 'required|string',
            'logo_alt2_en' => 'required|string',
            'logo_alt2_ru' => 'required|string',
            'logo_title1_az' => 'required|string',
            'logo_title1_en' => 'required|string',
            'logo_title1_ru' => 'required|string',
            'logo_title2_az' => 'required|string',
            'logo_title2_en' => 'required|string',
            'logo_title2_ru' => 'required|string',
        ], [
            'logo_1_image.required' => 'Logo 1 şəkli mütləq yüklənməlidir',
            'logo_2_image.required' => 'Logo 2 şəkli mütləq yüklənməlidir',
        ]);

        $logo = new Logo();

        try {
            // Logo 1 için dosya yükleme
            if ($request->hasFile('logo_1_image')) {
                $file = $request->file('logo_1_image');
                if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
                    return redirect()->back()->withErrors(['logo_1_image' => 'Desteklenmeyen dosya formatı. Lütfen JPG, JPEG, PNG, GIF, SVG veya WEBP formatında bir dosya yükleyin.']);
                }
                $logo->logo_1_image = $this->handleImageUpload($file, 'logo1');
            }

            // Logo 2 için dosya yükleme
            if ($request->hasFile('logo_2_image')) {
                $file = $request->file('logo_2_image');
                if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
                    return redirect()->back()->withErrors(['logo_2_image' => 'Desteklenmeyen dosya formatı. Lütfen JPG, JPEG, PNG, GIF, SVG veya WEBP formatında bir dosya yükleyin.']);
                }
                $logo->logo_2_image = $this->handleImageUpload($file, 'logo2');
            }

            // Diğer alanları kaydet
            $logo->logo_alt1_az = $request->logo_alt1_az;
            $logo->logo_alt1_en = $request->logo_alt1_en;
            $logo->logo_alt1_ru = $request->logo_alt1_ru;
            $logo->logo_alt2_az = $request->logo_alt2_az;
            $logo->logo_alt2_en = $request->logo_alt2_en;
            $logo->logo_alt2_ru = $request->logo_alt2_ru;
            $logo->logo_title1_az = $request->logo_title1_az;
            $logo->logo_title1_en = $request->logo_title1_en;
            $logo->logo_title1_ru = $request->logo_title1_ru;
            $logo->logo_title2_az = $request->logo_title2_az;
            $logo->logo_title2_en = $request->logo_title2_en;
            $logo->logo_title2_ru = $request->logo_title2_ru;

            $logo->save();
            return redirect()->route('back.pages.logos.index')->with('success', 'Logo başarıyla eklendi.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Logo işlenirken bir hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $logo = Logo::findOrFail($id);
        return view('back.admin.logos.edit', compact('logo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'logo_1_image' => 'nullable|max:2048',
            'logo_2_image' => 'nullable|max:2048',
            'logo_alt1_az' => 'required|string',
            'logo_alt1_en' => 'required|string',
            'logo_alt1_ru' => 'required|string',
            'logo_alt2_az' => 'required|string',
            'logo_alt2_en' => 'required|string',
            'logo_alt2_ru' => 'required|string',
            'logo_title1_az' => 'required|string',
            'logo_title1_en' => 'required|string',
            'logo_title1_ru' => 'required|string',
            'logo_title2_az' => 'required|string',
            'logo_title2_en' => 'required|string',
            'logo_title2_ru' => 'required|string',
        ]);

        $logo = Logo::findOrFail($id);

        try {
            // Logo 1 için dosya güncelleme
            if ($request->hasFile('logo_1_image')) {
                $file = $request->file('logo_1_image');
                if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
                    return redirect()->back()->withErrors(['logo_1_image' => 'Desteklenmeyen dosya formatı. Lütfen JPG, JPEG, PNG, GIF, SVG veya WEBP formatında bir dosya yükleyin.']);
                }

                // Eski dosyayı sil
                if ($logo->logo_1_image && File::exists(public_path($logo->logo_1_image))) {
                    File::delete(public_path($logo->logo_1_image));
                }

                $logo->logo_1_image = $this->handleImageUpload($file, 'logo1');
            }

            // Logo 2 için dosya güncelleme
            if ($request->hasFile('logo_2_image')) {
                $file = $request->file('logo_2_image');
                if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
                    return redirect()->back()->withErrors(['logo_2_image' => 'Desteklenmeyen dosya formatı. Lütfen JPG, JPEG, PNG, GIF, SVG veya WEBP formatında bir dosya yükleyin.']);
                }

                // Eski dosyayı sil
                if ($logo->logo_2_image && File::exists(public_path($logo->logo_2_image))) {
                    File::delete(public_path($logo->logo_2_image));
                }

                $logo->logo_2_image = $this->handleImageUpload($file, 'logo2');
            }

            // Diğer alanları güncelle
            $logo->logo_alt1_az = $request->logo_alt1_az;
            $logo->logo_alt1_en = $request->logo_alt1_en;
            $logo->logo_alt1_ru = $request->logo_alt1_ru;
            $logo->logo_alt2_az = $request->logo_alt2_az;
            $logo->logo_alt2_en = $request->logo_alt2_en;
            $logo->logo_alt2_ru = $request->logo_alt2_ru;
            $logo->logo_title1_az = $request->logo_title1_az;
            $logo->logo_title1_en = $request->logo_title1_en;
            $logo->logo_title1_ru = $request->logo_title1_ru;
            $logo->logo_title2_az = $request->logo_title2_az;
            $logo->logo_title2_en = $request->logo_title2_en;
            $logo->logo_title2_ru = $request->logo_title2_ru;

            $logo->save();
            return redirect()->route('back.pages.logos.index')->with('success', 'Logo uğurla yeniləndi.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Logo güncellenirken bir hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $logo = Logo::findOrFail($id);
        
        // Eski dosyayı sil
        if ($logo->logo_1_image && File::exists(public_path($logo->logo_1_image))) {
            File::delete(public_path($logo->logo_1_image));
        }
        
        if ($logo->logo_2_image && File::exists(public_path($logo->logo_2_image))) {
            File::delete(public_path($logo->logo_2_image));
        }

        $logo->delete();

        return redirect()->route('back.pages.logos.index')->with('success', 'Logo başarıyla silindi.');
    }

    public function toggleStatus($id)
    {
        $logo = Logo::findOrFail($id);
        if ($logo->status) {
            $logo->status = null; // Durumu kaldır
        } else {
            $logo->status = 1; // Durumu aktif yap
        }
        $logo->save();

        return redirect()->route('back.pages.logos.index')->with('success', 'Status uğurla dəyişdirildi');
    }
}