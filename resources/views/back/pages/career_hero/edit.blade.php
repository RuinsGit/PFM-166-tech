@extends('back.layouts.master')

@section('title', 'Karyera Qəhrəmanını Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Karyera Qəhrəmanını Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.career_hero.index') }}">Karyera Qəhrəmanları</a></li>
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
                            <form action="{{ route('back.pages.career_hero.update', $careerHero->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Şəkil və Video Bölməsi -->
                                <div class="row mb-3">
                                    <!-- Şəkil -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Şəkil</label>
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($careerHero->image)
                                                <img src="{{ asset($careerHero->image) }}" alt="" style="width: 100px; height: auto;" class="mt-2">
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Video -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Video</label>
                                            <input type="file" name="video" class="form-control @error('video') is-invalid @enderror">
                                            @error('video')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($careerHero->video)
                                                <video width="320" height="240" controls class="mt-2">
                                                    <source src="{{ asset($careerHero->video) }}" type="video/mp4">
                                                    Brauzeriniz video təqini dəstəkləmir.
                                                </video>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Dil Tabları -->
                                <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            Azərbaycan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            İngilis
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            Rus
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab məzmunu -->
                                <div class="tab-content">
                                    <!-- Azərbaycan dili -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Şəkil Alt Mətni (AZ)</label>
                                            <input type="text" name="image_alt_az" class="form-control @error('image_alt_az') is-invalid @enderror" value="{{ $careerHero->image_alt_az }}" required>
                                            @error('image_alt_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Məzmun (AZ)</label>
                                            <textarea name="description_az" class="form-control @error('description_az') is-invalid @enderror" required>{{ $careerHero->description_az }}</textarea>
                                            @error('description_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- İngilis dili -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Şəkil Alt Mətni (EN)</label>
                                            <input type="text" name="image_alt_en" class="form-control @error('image_alt_en') is-invalid @enderror" value="{{ $careerHero->image_alt_en }}" required>
                                            @error('image_alt_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Məzmun (EN)</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" required>{{ $careerHero->description_en }}</textarea>
                                            @error('description_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rus dili -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Şəkil Alt Mətni (RU)</label>
                                            <input type="text" name="image_alt_ru" class="form-control @error('image_alt_ru') is-invalid @enderror" value="{{ $careerHero->image_alt_ru }}" required>
                                            @error('image_alt_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Məzmun (RU)</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" required>{{ $careerHero->description_ru }}</textarea>
                                            @error('description_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.career_hero.index') }}" class="btn btn-secondary">Ləğv et</a>
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