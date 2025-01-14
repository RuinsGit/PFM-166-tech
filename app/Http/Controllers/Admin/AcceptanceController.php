<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acceptance;
use Illuminate\Http\Request;

class AcceptanceController extends Controller
{
    public function index()
    {
        $acceptances = Acceptance::all();
        return view('back.pages.acceptance.index', compact('acceptances'));
    }

    public function create()
    {
        return view('back.pages.acceptance.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'required|string',
            'text_ru' => 'required|string',
        ]);

        Acceptance::create($data);

        return redirect()->route('back.pages.acceptance.index')->with('success', 'Qəbul uğurla yaradıldı.');
    }

    public function edit($id)
    {
        $acceptance = Acceptance::findOrFail($id);
        return view('back.pages.acceptance.edit', compact('acceptance'));
    }

    public function update(Request $request, $id)
    {
        $acceptance = Acceptance::findOrFail($id);

        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'required|string',
            'text_ru' => 'required|string',
        ]);

        $acceptance->update($data);

        return redirect()->route('back.pages.acceptance.index')->with('success', 'Qəbul uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $acceptance = Acceptance::findOrFail($id);
        $acceptance->delete();

        return redirect()->route('back.pages.acceptance.index')->with('success', 'Qəbul uğurla silindi.');
    }
}