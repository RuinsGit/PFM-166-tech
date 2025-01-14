@extends('back.layouts.master')

@section('title', 'Galeri Tipini Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Galeri Tipini Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.gallery_type.index') }}">Galeri Tipleri</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('back.pages.gallery_type.update', $galleryType->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Galeri Tipi Başlığı (AZ) -->
                                <div class="mb-3">
                                    <label class="form-label">Başlıq (AZ)</label>
                                    <input type="text" name="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ $galleryType->title_az }}" required>
                                    @error('title_az')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Galeri Tipi Başlığı (EN) -->
                                <div class="mb-3">
                                    <label class="form-label">Title (EN)</label>
                                    <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ $galleryType->title_en }}" required>
                                    @error('title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Galeri Tipi Başlığı (RU) -->
                                <div class="mb-3">
                                    <label class="form-label">Название (RU)</label>
                                    <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ $galleryType->title_ru }}" required>
                                    @error('title_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Durum -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="1" {{ $galleryType->status ? 'selected' : '' }}>Aktiv</option>
                                        <option value="0" {{ !$galleryType->status ? 'selected' : '' }}>Pasif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.gallery_type.index') }}" class="btn btn-secondary">Ləğv et</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 