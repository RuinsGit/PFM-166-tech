<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keyfiyet;
use Illuminate\Http\Request;

class KeyfiyetController extends Controller
{
    public function index()
    {
        $keyfiyets = Keyfiyet::all(); // Tüm kayıtları al
        return view('back.pages.keyfiyet.index', compact('keyfiyets'));
    }

    public function create()
    {
        return view('back.pages.keyfiyet.create');
    }

    public function store(Request $request)
    {
        // Veritabanında zaten bir kayıt var mı kontrol et
        if (Keyfiyet::count() >= 1) {
            return redirect()->route('back.pages.keyfiyet.index')->with('error', 'Hal-hazırda bir keyfiyet mövcuddur. Yeni bir keyfiyet əlavə edə bilməzsiniz.');
        }

        $request->validate([
            'number_filial' => 'required|integer',
            'number_customer' => 'required|integer',
            'number_keyfiyet' => 'required|integer',
            'filial_title_az' => 'required|string|max:255',
            'filial_title_en' => 'required|string|max:255',
            'filial_title_ru' => 'required|string|max:255',
            'customer_title_az' => 'required|string|max:255',
            'customer_title_en' => 'required|string|max:255',
            'customer_title_ru' => 'required|string|max:255',
            'keyfiyet_title_az' => 'required|string|max:255',
            'keyfiyet_title_en' => 'required|string|max:255',
            'keyfiyet_title_ru' => 'required|string|max:255',
        ]);

        Keyfiyet::create($request->all());

        return redirect()->route('back.pages.keyfiyet.index')->with('success', 'Keyfiyet uğurla yaradıldı.');
    }

    public function edit($id)
    {
        $keyfiyet = Keyfiyet::findOrFail($id);
        return view('back.pages.keyfiyet.edit', compact('keyfiyet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'number_filial' => 'required|integer',
            'number_customer' => 'required|integer',
            'number_keyfiyet' => 'required|integer',
            'filial_title_az' => 'required|string|max:255',
            'filial_title_en' => 'required|string|max:255',
            'filial_title_ru' => 'required|string|max:255',
            'customer_title_az' => 'required|string|max:255',
            'customer_title_en' => 'required|string|max:255',
            'customer_title_ru' => 'required|string|max:255',
            'keyfiyet_title_az' => 'required|string|max:255',
            'keyfiyet_title_en' => 'required|string|max:255',
            'keyfiyet_title_ru' => 'required|string|max:255',
        ]);

        $keyfiyet = Keyfiyet::findOrFail($id);
        $keyfiyet->update($request->all());

        return redirect()->route('back.pages.keyfiyet.index')->with('success', 'Keyfiyet uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $keyfiyet = Keyfiyet::findOrFail($id);
        $keyfiyet->delete();

        return redirect()->route('back.pages.keyfiyet.index')->with('success', 'Keyfiyet uğurla silindi.');
    }
}
