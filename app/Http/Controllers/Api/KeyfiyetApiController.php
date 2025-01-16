<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KeyfiyetResource; // KeyfiyetResource'ı ekleyin
use App\Models\Keyfiyet;
use Illuminate\Http\Request;

class KeyfiyetApiController extends Controller
{
    public function index()
    {
        $keyfiyets = Keyfiyet::all(); // Tüm keyfiyetleri al
        return KeyfiyetResource::collection($keyfiyets); // Kayıtları döndür
    }

    public function show($id)
    {
        try {
            $keyfiyet = Keyfiyet::findOrFail($id); // Belirli keyfiyeti al
            return new KeyfiyetResource($keyfiyet); // Kaydı döndür
        } catch (\Exception $e) {
            return response()->json(['message' => 'Keyfiyet not found'], 404); // Hata durumunda mesaj döndür
        }
    }

   

   

    public function destroy($id)
    {
        $keyfiyet = Keyfiyet::findOrFail($id); // Belirli keyfiyeti al
        $keyfiyet->delete(); // Keyfiyeti sil
        return response()->json(['message' => 'Keyfiyet successfully deleted.'], 200); // Başarılı mesajı döndür
    }
}