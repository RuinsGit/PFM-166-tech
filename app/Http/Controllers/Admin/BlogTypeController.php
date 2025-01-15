<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogType;
use Illuminate\Http\Request;

class BlogTypeController extends Controller
{
    public function index()
    {
        $blog_types = BlogType::all();
        return view('back.pages.blog_type.index', compact('blog_types'));
    }

    public function create()
    {
        return view('back.pages.blog_type.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255'
        ]);

        $data['status'] = true;

        BlogType::create($data);

        return redirect()->route('back.pages.blog_type.index')->with('success', 'Bloq tipi uğurla yaradıldı.');
    }

    public function edit($id)
    {
        $blog_type = BlogType::findOrFail($id);
        return view('back.pages.blog_type.edit', compact('blog_type'));
    }

    public function update(Request $request, $id)
    {
        $blog_type = BlogType::findOrFail($id);

        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255'
        ]);

        $data['status'] = true;

        $blog_type->update($data);

        return redirect()->route('back.pages.blog_type.index')->with('success', 'Bloq tipi uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $blog_type = BlogType::findOrFail($id);
        $blog_type->delete();

        return redirect()->route('back.pages.blog_type.index')->with('success', 'Bloq tipi uğurla silindi.');
    }
} 