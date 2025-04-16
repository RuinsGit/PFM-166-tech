<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Artisan::call('migrate');
        $certificates = Certificate::paginate(10);
        return view('back.pages.certificate.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'title_az' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'created_at' => 'nullable|date',
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/certificates'), $imageName);
                $data['image'] = 'uploads/certificates/' . $imageName;
            }

            if ($request->hasFile('pdf')) {
                $pdf = $request->file('pdf');
                $pdfName = time() . '_pdf.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path('uploads/certificates'), $pdfName);
                $data['pdf'] = 'uploads/certificates/' . $pdfName;
            }
            
            // Tarih ayarlanmışsa kullan, aksi takdirde şimdiki zamanı kullan
            if(!empty($request->created_at)) {
                $data['created_at'] = $request->created_at;
            }

            Certificate::create($data);

            return redirect()
                ->route('back.pages.certificate.index')
                ->with('success', 'Sertifikat uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('back.pages.certificate.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'title_az' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'created_at' => 'nullable|date',
        ]);

        try {
            $certificate = Certificate::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('image')) {
                if ($certificate->image && File::exists(public_path($certificate->image))) {
                    File::delete(public_path($certificate->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/certificates'), $imageName);
                $data['image'] = 'uploads/certificates/' . $imageName;
            }

            if ($request->hasFile('pdf')) {
                if ($certificate->pdf && File::exists(public_path($certificate->pdf))) {
                    File::delete(public_path($certificate->pdf));
                }

                $pdf = $request->file('pdf');
                $pdfName = time() . '_pdf.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path('uploads/certificates'), $pdfName);
                $data['pdf'] = 'uploads/certificates/' . $pdfName;
            }
            
            // Eğer created_at değeri ayarlanmışsa, bu değeri kullan
            if(!empty($request->created_at)) {
                $data['created_at'] = $request->created_at;
            }

            $certificate->update($data);

            return redirect()
                ->route('back.pages.certificate.index')
                ->with('success', 'Sertifikat uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $certificate = Certificate::findOrFail($id);

            if ($certificate->image && File::exists(public_path($certificate->image))) {
                File::delete(public_path($certificate->image));
            }

            if ($certificate->pdf && File::exists(public_path($certificate->pdf))) {
                File::delete(public_path($certificate->pdf));
            }

            $certificate->delete();

            return redirect()
                ->route('back.pages.certificate.index')
                ->with('success', 'Sertifikat uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
