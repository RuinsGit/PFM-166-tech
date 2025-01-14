@extends('back.layouts.master')

@section('title', 'Galeri Tipleri')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Galeri Tipleri</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Galeri Tipleri</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('back.pages.gallery_type.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Yeni Galeri Tipi
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Başlıq (AZ)</th>
                                            <th>Title (EN)</th>
                                            <th>Название (RU)</th>
                                            <th>Status</th>
                                            <th class="text-center" style="width: 150px;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($galleryTypes as $galleryType)
                                            <tr>
                                                <td>{{ $galleryType->id }}</td>
                                                <td>{{ $galleryType->title_az }}</td>
                                                <td>{{ $galleryType->title_en }}</td>
                                                <td>{{ $galleryType->title_ru }}</td>
                                                <td>{{ $galleryType->status ? 'Aktiv' : 'Pasif' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('back.pages.gallery_type.edit', $galleryType->id) }}" 
                                                        class="btn btn-warning btn-sm" title="Düzəlt">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <form action="{{ route('back.pages.gallery_type.destroy', $galleryType->id) }}" 
                                                        method="POST" class="d-inline-block" onsubmit="return confirm('Silmək istədiyinizə əminsiniz?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Sil">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Heç bir məlumat tapılmadı.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 