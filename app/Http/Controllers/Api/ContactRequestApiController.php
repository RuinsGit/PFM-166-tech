<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactRequestResource;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactRequestApiController extends Controller
{
    public function index()
    {
        $contactRequests = ContactRequest::orderBy('created_at', 'desc')->get();
        return ContactRequestResource::collection($contactRequests);
    }

    public function show($id)
    {
        $contactRequest = ContactRequest::find($id);
        if (!$contactRequest) {
            return response()->json(['message' => 'Contact request not found'], 404);
        }

        if ($contactRequest->status === ContactRequest::STATUS_NEW) {
            $contactRequest->update(['status' => ContactRequest::STATUS_VIEWED]);
        }

        return new ContactRequestResource($contactRequest);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'number' => 'required|string|max:20',
                'description' => 'required|string'
            ]);

            DB::beginTransaction();
            
            $contactRequest = ContactRequest::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'number' => $validated['number'],
                'description' => $validated['description'],
                'status' => ContactRequest::STATUS_NEW
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Contact request created successfully',
                'data' => new ContactRequestResource($contactRequest)
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occurred while creating the contact request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $contactRequest = ContactRequest::findOrFail($id);
            $contactRequest->delete();

            return response()->json(['message' => 'Contact request successfully deleted'], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the contact request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 