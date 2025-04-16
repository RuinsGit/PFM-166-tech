<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CertificateResource;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Tüm sertifikaları listeler
     */
    public function index()
    {
        $certificates = Certificate::orderBy('created_at', 'desc')->get();
        return CertificateResource::collection($certificates);
    }

    /**
     * Belirli bir sertifikayı gösterir
     */
    public function show($id)
    {
        try {
            $certificate = Certificate::findOrFail($id);
            return new CertificateResource($certificate);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Sertifikat tapılmadı'], 404);
        }
    }
}
