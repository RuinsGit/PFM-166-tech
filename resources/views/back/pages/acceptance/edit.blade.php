@extends('back.layouts.master')

@section('title', 'Qəbulu Redaktə et')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Qəbulu Redaktə et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.acceptance.index') }}">Qəbul</a></li>
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
                            <form action="{{ route('back.pages.acceptance.update', $acceptance->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Dil Sekmeleri -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="az-tab" data-bs-toggle="tab" href="#az" role="tab" aria-controls="az" aria-selected="true">AZ</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="en-tab" data-bs-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">EN</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="ru-tab" data-bs-toggle="tab" href="#ru" role="tab" aria-controls="ru" aria-selected="false">RU</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <!-- Azerice -->
                                    <div class="tab-pane fade show active" id="az" role="tabpanel" aria-labelledby="az-tab">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq (AZ)</label>
                                            <input type="text" name="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ $acceptance->title_az }}" required>
                                            @error('title_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Məzmun (AZ)</label>
                                            <textarea name="text_az" class="form-control @error('text_az') is-invalid @enderror" required>{{ $acceptance->text_az }}</textarea>
                                            @error('text_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- İngilizce -->
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq (EN)</label>
                                            <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ $acceptance->title_en }}" required>
                                            @error('title_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Məzmun (EN)</label>
                                            <textarea name="text_en" class="form-control @error('text_en') is-invalid @enderror" required>{{ $acceptance->text_en }}</textarea>
                                            @error('text_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rusça -->
                                    <div class="tab-pane fade" id="ru" role="tabpanel" aria-labelledby="ru-tab">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq (RU)</label>
                                            <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ $acceptance->title_ru }}" required>
                                            @error('title_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Məzmun (RU)</label>
                                            <textarea name="text_ru" class="form-control @error('text_ru') is-invalid @enderror" required>{{ $acceptance->text_ru }}</textarea>
                                            @error('text_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.acceptance.index') }}" class="btn btn-secondary">Ləğv et</a>
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