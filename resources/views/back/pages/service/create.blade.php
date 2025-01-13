@extends('back.layouts.master')

@section('title', 'Yeni Service')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Service</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.service.index') }}">Services</a></li>
                                <li class="breadcrumb-item active">Yeni</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('back.pages.service.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="image">Şəkil</label>
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bottom_image">Alt Şəkil</label>
                                        <input type="file" name="bottom_image" id="bottom_image" class="form-control @error('bottom_image') is-invalid @enderror">
                                        @error('bottom_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                            <div class="mb-3">
                                                <label class="form-label">Şəkil ALT</label>
                                                <input type="text" name="image_alt_az" class="form-control" value="{{ old('image_alt_az') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alt Şəkil ALT</label>
                                                <input type="text" name="bottom_image_alt_az" class="form-control" value="{{ old('bottom_image_alt_az') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Meta Title</label>
                                                <input type="text" name="meta_title_az" class="form-control @error('meta_title_az') is-invalid @enderror" value="{{ old('meta_title_az') }}">
                                                @error('meta_title_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Meta Description</label>
                                                <textarea name="meta_description_az" class="form-control @error('meta_description_az') is-invalid @enderror">{{ old('meta_description_az') }}</textarea>
                                                @error('meta_description_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Başlıq</label>
                                                <input type="text" name="title1_az" class="form-control @error('title1_az') is-invalid @enderror" value="{{ old('title1_az') }}">
                                                @error('title1_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mətn</label>
                                                <textarea name="text1_az" class="form-control summernote @error('text1_az') is-invalid @enderror">{{ old('text1_az') }}</textarea>
                                                @error('text1_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alt Başlıq</label>
                                                <input type="text" name="title2_az" class="form-control @error('title2_az') is-invalid @enderror" value="{{ old('title2_az') }}">
                                                @error('title2_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alt Mətn</label>
                                                <textarea name="text2_az" class="form-control summernote @error('text2_az') is-invalid @enderror">{{ old('text2_az') }}</textarea>
                                                @error('text2_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <!-- EN içeriği - AZ ile aynı yapıda -->
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Image ALT</label>
                                                <input type="text" name="image_alt_en" class="form-control" value="{{ old('image_alt_en') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Bottom Image ALT</label>
                                                <input type="text" name="bottom_image_alt_en" class="form-control" value="{{ old('bottom_image_alt_en') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Meta Title</label>
                                                <input type="text" name="meta_title_en" class="form-control" value="{{ old('meta_title_en') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Meta Description</label>
                                                <textarea name="meta_description_en" class="form-control">{{ old('meta_description_en') }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="title1_en" class="form-control" value="{{ old('title1_en') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Text</label>
                                                <textarea name="text1_en" class="form-control summernote">{{ old('text1_en') }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alt Title</label>
                                                <input type="text" name="title2_en" class="form-control" value="{{ old('title2_en') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alt Text</label>
                                                <textarea name="text2_en" class="form-control summernote">{{ old('text2_en') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <!-- RU içeriği - AZ ile aynı yapıda -->
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Изображение ALT</label>
                                                <input type="text" name="image_alt_ru" class="form-control" value="{{ old('image_alt_ru') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Нижнее Изображение ALT</label>
                                                <input type="text" name="bottom_image_alt_ru" class="form-control" value="{{ old('bottom_image_alt_ru') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Meta Title</label>
                                                <input type="text" name="meta_title_ru" class="form-control" value="{{ old('meta_title_ru') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Meta Description</label>
                                                <textarea name="meta_description_ru" class="form-control">{{ old('meta_description_ru') }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Заголовок</label>
                                                <input type="text" name="title1_ru" class="form-control" value="{{ old('title1_ru') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Текст</label>
                                                <textarea name="text1_ru" class="form-control summernote">{{ old('text1_ru') }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alt Заголовок</label>
                                                <input type="text" name="title2_ru" class="form-control" value="{{ old('title2_ru') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alt Текст</label>
                                                <textarea name="text2_ru" class="form-control summernote">{{ old('text2_ru') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.service.index') }}" class="btn btn-secondary">Ləğv et</a>
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
