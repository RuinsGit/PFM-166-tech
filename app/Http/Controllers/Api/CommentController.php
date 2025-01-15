<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        return CommentResource::collection($comments);
    }

    public function show($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            return new CommentResource($comment);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'comment_az' => 'required|string',
            'comment_en' => 'nullable|string',
            'comment_ru' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        try {
            $data = $request->all();
            $comment = Comment::create($data);
            return new CommentResource($comment);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'comment_az' => 'required|string',
            'comment_en' => 'nullable|string',
            'comment_ru' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        try {
            $comment = Comment::findOrFail($id);
            $data = $request->all();
            $comment->update($data);
            return new CommentResource($comment);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return response()->json(['message' => 'Comment deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }
} 