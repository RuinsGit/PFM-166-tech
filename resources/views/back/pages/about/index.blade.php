@extends('back.layouts.master')

@section('title', 'Haqqımızda')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Haqqımızda</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item active">Haqqımızda</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Haqqımızda</h4>
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">AZ</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">EN</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">RU</span>
                                </a>
                            </li>
                        </ul>

                        <form action="{{ route('back.pages.about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="tab-content p-3 text-muted">
                                    <!-- Azərbaycan dili -->
                                    <div class="tab-pane active" id="az">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq (Az)</label>
                                            <input type="text" name="title_az" class="form-control" value="{{ $about?->title_az }}">
                                            @error('title_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mətn (Az)</label>
                                            <textarea name="description_az" class="form-control summernote">{{ $about?->description_az }}</textarea>
                                            @error('description_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- İngilis dili -->
                                    <div class="tab-pane" id="en">
                                        <div class="mb-3">
                                            <label class="form-label">Title (En)</label>
                                            <input type="text" name="title_en" class="form-control" value="{{ $about?->title_en }}">
                                            @error('title_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (En)</label>
                                            <textarea name="description_en" class="form-control summernote">{{ $about?->description_en }}</textarea>
                                            @error('description_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rus dili -->
                                    <div class="tab-pane" id="ru">
                                        <div class="mb-3">
                                            <label class="form-label">Заголовок (Ru)</label>
                                            <input type="text" name="title_ru" class="form-control" value="{{ $about?->title_ru }}">
                                            @error('title_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Описание (Ru)</label>
                                            <textarea name="description_ru" class="form-control summernote">{{ $about?->description_ru }}</textarea>
                                            @error('description_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Video</label>
                                        <input type="file" name="video" class="form-control" accept="video/*">
                                        @error('video')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                        
                                        @if($about?->video)
                                            <div class="mt-2">
                                                <div class="video-preview">
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ asset($about->video) }}" type="video/mp4">
                                                        Tarayıcınız video etiketini desteklemiyor.
                                                    </video>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.video-preview {
    width: 320px;
    height: 240px;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin: 0 auto;
}

.video-preview video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease;
}

.video-preview:hover video {
    transform: scale(1.05);
}

.card {
    border: none;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
    border-radius: 12px;
    overflow: hidden;
}

.nav-tabs {
    border-bottom: 2px solid #eee;
    margin-bottom: 20px;
}

.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    padding: 12px 20px;
    transition: all 0.2s ease;
}

.nav-tabs .nav-link.active {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    background: transparent;
}

.nav-tabs .nav-link:hover {
    border-color: transparent;
    color: #3498db;
}

.form-label {
    font-weight: 500;
    color: #2c3e50;
    margin-bottom: 8px;
}

.form-control {
    border-radius: 6px;
    border: 1px solid #dee2e6;
    padding: 8px 12px;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
    border-radius: 6px;
}

.btn-primary {
    background-color: #3498db;
    border-color: #3498db;
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.btn-secondary {
    background-color: #95a5a6;
    border-color: #95a5a6;
}

.btn-secondary:hover {
    background-color: #7f8c8d;
    border-color: #7f8c8d;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.tab-content {
    padding: 20px;
    background-color: #fff;
    border-radius: 0 0 8px 8px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .video-preview {
        width: 100%;
        height: auto;
    }
    
    .nav-tabs .nav-link {
        padding: 8px 12px;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $(".summernote").summernote();
        $('.dropdown-toggle').dropdown();
    });
</script>
@endpush 