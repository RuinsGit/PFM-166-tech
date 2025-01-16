<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VacationHeroResource;
use App\Models\VacationHero;
use Illuminate\Http\Request;

class VacationHeroApiController extends Controller
{
    public function index()
    {
        $vacationHeroes = VacationHero::all();
        if ($vacationHeroes->isEmpty()) {
            return response()->json(['message' => 'No Vacation Heroes found'], 404);
        }
        return VacationHeroResource::collection($vacationHeroes);
    }

    public function show($id)
    {
        $vacationHero = VacationHero::find($id);
        if (!$vacationHero) {
            return response()->json(['message' => 'Vacation Hero not found'], 404);
        }
        return new VacationHeroResource($vacationHero);
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

        $vacationHero = VacationHero::create($data);

        return response()->json(new VacationHeroResource($vacationHero), 201);
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

        return response()->json(new VacationHeroResource($vacationHero), 200);
    }

    public function destroy($id)
    {
        $vacationHero = VacationHero::findOrFail($id);
        
        // Resmi sil
        if ($vacationHero->image) {
            unlink(public_path($vacationHero->image));
        }
        
        $vacationHero->delete();

        return response()->json(['message' => 'Vacation Hero successfully deleted'], 204);
    }
} 