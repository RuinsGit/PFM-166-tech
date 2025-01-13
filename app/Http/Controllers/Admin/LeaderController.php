<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LeaderController extends Controller
{
    public function index()
    {
        $leaders = Leader::latest()->get();
        return view('back.pages.leader.index', compact('leaders'));
    }

    public function create()
    {
        return view('back.pages.leader.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'position_az' => 'required|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'position_ru' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/leaders'), $filename);
                $data['image'] = 'uploads/leaders/' . $filename;
            }

            Leader::create($data);

            return redirect()
                ->route('back.pages.leaders.index')
                ->with('success', 'Lider uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $leader = Leader::findOrFail($id);
        return view('back.pages.leader.edit', compact('leader'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'position_az' => 'required|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'position_ru' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        try {
            $leader = Leader::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('image')) {
                // Delete old image
                if ($leader->image && File::exists(public_path($leader->image))) {
                    File::delete(public_path($leader->image));
                }

                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/leaders'), $filename);
                $data['image'] = 'uploads/leaders/' . $filename;
            }

            $leader->update($data);

            return redirect()
                ->route('back.pages.leaders.index')
                ->with('success', 'Lider uğurla yeniləndi');

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
            $leader = Leader::findOrFail($id);

            if ($leader->image && File::exists(public_path($leader->image))) {
                File::delete(public_path($leader->image));
            }

            $leader->delete();

            return redirect()
                ->route('back.pages.leaders.index')
                ->with('success', 'Lider uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        try {
            $leader = Leader::findOrFail($id);
            $leader->status = !$leader->status;
            $leader->save();

            return response()->json([
                'success' => true,
                'status' => $leader->status,
                'message' => 'Status uğurla dəyişdirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
}
