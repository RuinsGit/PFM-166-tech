<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('back.pages.comment.index', compact('comments'));
    }

    public function create()
    {
        return view('back.pages.comment.create');
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

            Comment::create($data);

            return redirect()
                ->route('back.pages.comments.index')
                ->with('success', 'Rəy uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('back.pages.comment.edit', compact('comment'));
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

            return redirect()
                ->route('back.pages.comments.index')
                ->with('success', 'Rəy uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);

            if ($comment->image && File::exists(public_path($comment->image))) {
                File::delete(public_path($comment->image));
            }

            $comment->delete();

            return redirect()
                ->route('back.pages.comments.index')
                ->with('success', 'Rəy uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->status = !$comment->status;
            $comment->save();

            return response()->json([
                'success' => true,
                'message' => 'Status uğurla yeniləndi',
                'status' => $comment->status
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
}