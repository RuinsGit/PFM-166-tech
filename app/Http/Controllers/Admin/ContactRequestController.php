<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function index()
    {
        $contactRequests = ContactRequest::orderBy('created_at', 'desc')->get();
        return view('back.pages.contact_requests.index', compact('contactRequests'));
    }

    public function show($id)
    {
        $contactRequest = ContactRequest::findOrFail($id);
        
        if ($contactRequest->status === ContactRequest::STATUS_NEW) {
            $contactRequest->update(['status' => ContactRequest::STATUS_VIEWED]);
        }
        
        return view('back.pages.contact_requests.show', compact('contactRequest'));
    }

    public function destroy($id)
    {
        $contactRequest = ContactRequest::findOrFail($id);
        $contactRequest->delete();
        
        return redirect()->route('back.pages.contact_requests.index')
            ->with('success', 'Müraciət uğurla silindi.');
    }
} 