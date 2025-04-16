<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class ServiceController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $services = Service::paginate(1);
        return view('back.pages.service.index', compact('services'));
    }

    public function create()
    {
        return view('back.pages.service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'bottom_image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'bottom_image_alt_az' => 'nullable|string|max:255',
            'bottom_image_alt_en' => 'nullable|string|max:255',
            'bottom_image_alt_ru' => 'nullable|string|max:255',
            'meta_title_az' => 'required|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'required|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
            'title1_az' => 'required|string|max:255',
            'title1_en' => 'nullable|string|max:255',
            'title1_ru' => 'nullable|string|max:255',
            'text1_az' => 'required|string',
            'text1_en' => 'nullable|string',
            'text1_ru' => 'nullable|string',
            'title2_az' => 'required|string|max:255',
            'title2_en' => 'nullable|string|max:255',
            'title2_ru' => 'nullable|string|max:255',
            'text2_az' => 'required|string',
            'text2_en' => 'nullable|string',
            'text2_ru' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'images_alt_az.*' => 'nullable|string|max:255',
            'images_alt_en.*' => 'nullable|string|max:255',
            'images_alt_ru.*' => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->all();

            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/services'), $imageName);
                $data['image'] = 'uploads/services/' . $imageName;
            }

            if ($request->hasFile('bottom_image')) {
                $bottomImage = $request->file('bottom_image');
                $bottomImageName = time() . '_bottom.' . $bottomImage->getClientOriginalExtension();
                $bottomImage->move(public_path('uploads/services'), $bottomImageName);
                $data['bottom_image'] = 'uploads/services/' . $bottomImageName;
            }

            $service = Service::create($data);
            
            // Çoklu resim işleme
            if ($request->hasFile('images')) {
                $order = 0;
                foreach ($request->file('images') as $key => $image) {
                    $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/services/gallery'), $imageName);
                    
                    $service->images()->create([
                        'image' => 'uploads/services/gallery/' . $imageName,
                        'alt_az' => $request->images_alt_az[$key] ?? null,
                        'alt_en' => $request->images_alt_en[$key] ?? null,
                        'alt_ru' => $request->images_alt_ru[$key] ?? null,
                        'order' => $order++
                    ]);
                }
            }

            return redirect()
                ->route('back.pages.service.index')
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
        $service = Service::with('images')->findOrFail($id);
        return view('back.pages.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'bottom_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'bottom_image_alt_az' => 'nullable|string|max:255',
            'bottom_image_alt_en' => 'nullable|string|max:255',
            'bottom_image_alt_ru' => 'nullable|string|max:255',
            'meta_title_az' => 'required|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'required|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
            'title1_az' => 'required|string|max:255',
            'title1_en' => 'nullable|string|max:255',
            'title1_ru' => 'nullable|string|max:255',
            'text1_az' => 'required|string',
            'text1_en' => 'nullable|string',
            'text1_ru' => 'nullable|string',
            'title2_az' => 'required|string|max:255',
            'title2_en' => 'nullable|string|max:255',
            'title2_ru' => 'nullable|string|max:255',
            'text2_az' => 'required|string',
            'text2_en' => 'nullable|string',
            'text2_ru' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'images_alt_az.*' => 'nullable|string|max:255',
            'images_alt_en.*' => 'nullable|string|max:255',
            'images_alt_ru.*' => 'nullable|string|max:255',
            'existing_images_alt_az.*' => 'nullable|string|max:255',
            'existing_images_alt_en.*' => 'nullable|string|max:255',
            'existing_images_alt_ru.*' => 'nullable|string|max:255',
            'deleted_images.*' => 'nullable|integer',
        ]);

        try {
            $service = Service::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('image')) {
                if ($service->image && File::exists(public_path($service->image))) {
                    File::delete(public_path($service->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/services'), $imageName);
                $data['image'] = 'uploads/services/' . $imageName;
            }

            if ($request->hasFile('bottom_image')) {
                if ($service->bottom_image && File::exists(public_path($service->bottom_image))) {
                    File::delete(public_path($service->bottom_image));
                }

                $bottomImage = $request->file('bottom_image');
                $bottomImageName = time() . '_bottom.' . $bottomImage->getClientOriginalExtension();
                $bottomImage->move(public_path('uploads/services'), $bottomImageName);
                $data['bottom_image'] = 'uploads/services/' . $bottomImageName;
            }

            $service->update($data);
            
            // Silinen resimleri işleme
            if ($request->has('deleted_images')) {
                foreach ($request->deleted_images as $imageId) {
                    $serviceImage = ServiceImage::find($imageId);
                    if ($serviceImage) {
                        if (File::exists(public_path($serviceImage->image))) {
                            File::delete(public_path($serviceImage->image));
                        }
                        $serviceImage->delete();
                    }
                }
            }
            
            // Mevcut resimleri güncelleme
            if ($request->has('existing_images_alt_az')) {
                foreach ($request->existing_images_alt_az as $imageId => $alt) {
                    $serviceImage = ServiceImage::find($imageId);
                    if ($serviceImage) {
                        $serviceImage->update([
                            'alt_az' => $alt,
                            'alt_en' => $request->existing_images_alt_en[$imageId] ?? null,
                            'alt_ru' => $request->existing_images_alt_ru[$imageId] ?? null,
                        ]);
                    }
                }
            }
            
            // Yeni resimleri ekleme
            if ($request->hasFile('images')) {
                $order = $service->images()->max('order') + 1;
                foreach ($request->file('images') as $key => $image) {
                    $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/services/gallery'), $imageName);
                    
                    $service->images()->create([
                        'image' => 'uploads/services/gallery/' . $imageName,
                        'alt_az' => $request->images_alt_az[$key] ?? null,
                        'alt_en' => $request->images_alt_en[$key] ?? null,
                        'alt_ru' => $request->images_alt_ru[$key] ?? null,
                        'order' => $order++
                    ]);
                }
            }

            return redirect()
                ->route('back.pages.service.index')
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
            $service = Service::findOrFail($id);

            if ($service->image && File::exists(public_path($service->image))) {
                File::delete(public_path($service->image));
            }
            if ($service->bottom_image && File::exists(public_path($service->bottom_image))) {
                File::delete(public_path($service->bottom_image));
            }
            
            // Çoklu resimleri silme
            foreach($service->images as $image) {
                if (File::exists(public_path($image->image))) {
                    File::delete(public_path($image->image));
                }
            }

            $service->delete();

            return redirect()
                ->route('back.pages.service.index')
                ->with('success', 'Məlumatlar uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
    
    public function updateImageOrder(Request $request)
    {
        try {
            foreach ($request->order as $id => $order) {
                ServiceImage::find($id)->update(['order' => $order]);
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
} 