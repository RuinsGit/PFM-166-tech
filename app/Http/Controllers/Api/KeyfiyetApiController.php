<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KeyfiyetResource;
use App\Models\Keyfiyet;
use Illuminate\Http\Request;

class KeyfiyetApiController extends Controller
{
    public function index()
    {
        $keyfiyets = Keyfiyet::first();
        return response()->json([
            'data' => new KeyfiyetResource($keyfiyets)
        ]);
    }

    public function show($id)
    {
        try {
            $keyfiyet = Keyfiyet::findOrFail($id);
            return new KeyfiyetResource($keyfiyet);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Keyfiyet not found'], 404);
        }
    }

    public function destroy($id)
    {
        $keyfiyet = Keyfiyet::findOrFail($id);
        $keyfiyet->delete();
        return response()->json(['message' => 'Keyfiyet successfully deleted.'], 200);
    }
}