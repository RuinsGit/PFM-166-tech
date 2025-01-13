@extends('back.layouts.master')

@section('title', 'About Hero Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">About Hero Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.about-hero.index') }}">About Hero</a></li>
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
                            <form action="{{ route('back.pages.about-hero.update', $aboutHero->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="image">Şəkil</label>
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        @if($aboutHero->image)
                                            <div class="mt-2">
                                                <img src="{{ asset($aboutHero->image) }}" alt="" 
                                                     style="max-width: 200px; max-height: 200px;">
                                            </div>
                                        @endif
                                        
                                        <!-- ALT etiketleri -->
                                        <div class="mt-2">
                                            <input type="text" name="image_alt_az" 
                                                   value="{{ old('image_alt_az', $aboutHero->image_alt_az) }}" 
                                                   class="form-control mb-2" placeholder="Şəkil ALT (AZ)">
                                            <input type="text" name="image_alt_en" 
                                                   value="{{ old('image_alt_en', $aboutHero->image_alt_en) }}" 
                                                   class="form-control mb-2" placeholder="Image ALT (EN)">
                                            <input type="text" name="image_alt_ru" 
                                                   value="{{ old('image_alt_ru', $aboutHero->image_alt_ru) }}" 
                                                   class="form-control" placeholder="Изображение ALT (RU)">
                                        </div>
                                    </div>
                                </div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Təsvir 1</label>
                                                <textarea name="description1_az" class="form-control summernote @error('description1_az') is-invalid @enderror">{{ old('description1_az', $aboutHero->description1_az) }}</textarea>
                                                @error('description1_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Təsvir 2</label>
                                                <textarea name="description2_az" class="form-control summernote @error('description2_az') is-invalid @enderror">{{ old('description2_az', $aboutHero->description2_az) }}</textarea>
                                                @error('description2_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Description 1</label>
                                                <textarea name="description1_en" class="form-control summernote @error('description1_en') is-invalid @enderror">{{ old('description1_en', $aboutHero->description1_en) }}</textarea>
                                                @error('description1_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Description 2</label>
                                                <textarea name="description2_en" class="form-control summernote @error('description2_en') is-invalid @enderror">{{ old('description2_en', $aboutHero->description2_en) }}</textarea>
                                                @error('description2_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Описание 1</label>
                                                <textarea name="description1_ru" class="form-control summernote @error('description1_ru') is-invalid @enderror">{{ old('description1_ru', $aboutHero->description1_ru) }}</textarea>
                                                @error('description1_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Описание 2</label>
                                                <textarea name="description2_ru" class="form-control summernote @error('description2_ru') is-invalid @enderror">{{ old('description2_ru', $aboutHero->description2_ru) }}</textarea>
                                                @error('description2_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.about-hero.index') }}" class="btn btn-secondary">Ləğv et</a>
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

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endpush 