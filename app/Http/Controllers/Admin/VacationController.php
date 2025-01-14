<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacation;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    public function index()
    {
        $vacations = Vacation::all();
        return view('back.pages.vacation.index', compact('vacations'));
    }

    public function create()
    {
        return view('back.pages.vacation.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'email' => 'required|email',
            'email_text' => 'required|string',
            'application_deadline' => 'required|date',
        ]);

        Vacation::create($data);

        return redirect()->route('back.pages.vacation.index')->with('success', 'Vacation başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $vacation = Vacation::findOrFail($id);
        return view('back.pages.vacation.edit', compact('vacation'));
    }

    public function update(Request $request, $id)
    {
        $vacation = Vacation::findOrFail($id);

        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'email' => 'required|email',
            'email_text' => 'required|string',
            'application_deadline' => 'required|date',
        ]);

        $vacation->update($data);

        return redirect()->route('back.pages.vacation.index')->with('success', 'Vacation başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->delete();

        return redirect()->route('back.pages.vacation.index')->with('success', 'Vacation başarıyla silindi.');
    }
}