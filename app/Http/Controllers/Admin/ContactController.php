<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_az' => 'required',
            'filial_name' => 'required',
            'filial_address' => 'required',
            // Diğer alanlar...
        ]);

        Contact::create($data);

        return redirect()->route('back.pages.contact.index')->with('success', 'Contact information added successfully');
    }
} 