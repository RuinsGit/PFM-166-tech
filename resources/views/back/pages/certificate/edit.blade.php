@extends('back.layouts.master')

@section('title', 'Sertifikat Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sertifikat Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.certificate.index') }}">Sertifikatlar</a></li>
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
                            <form action="{{ route('back.pages.certificate.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="image">Şəkil</label>
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        @if($certificate->image)
                                            <div class="mt-2">
                                                <img src="{{ asset($certificate->image) }}" alt="" style="max-width: 200px; max-height: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="pdf">PDF Fayl</label>
                                        <input type="file" name="pdf" id="pdf" class="form-control @error('pdf') is-invalid @enderror">
                                        @error('pdf')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        @if($certificate->pdf)
                                            <div class="mt-2">
                                                <a href="{{ asset($certificate->pdf) }}" target="_blank" class="btn btn-info">
                                                    <i class="fas fa-file-pdf"></i> Mövcud PDF
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Yaradılma tarixi</label>
                                        <input type="datetime-local" name="created_at" class="form-control" value="{{ \Carbon\Carbon::parse($certificate->created_at)->format('Y-m-d\TH:i') }}">
                                        <small class="text-muted">Tarix və saatı dəyişdirmək üçün</small>
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
                                                <label class="form-label">Başlıq</label>
                                                <input type="text" name="title_az" 
                                                       class="form-control @error('title_az') is-invalid @enderror" 
                                                       value="{{ old('title_az', $certificate->title_az) }}">
                                                @error('title_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="title_en" class="form-control" 
                                                       value="{{ old('title_en', $certificate->title_en) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Заголовок</label>
                                                <input type="text" name="title_ru" class="form-control" 
                                                       value="{{ old('title_ru', $certificate->title_ru) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.certificate.index') }}" class="btn btn-secondary">Ləğv et</a>
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