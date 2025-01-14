@extends('back.layouts.master')

@section('title', 'Vacation Redaktə et')

@section('content')
    <div class="page-content">
        <div class="container-fluid" >
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Vakansiya Redaktə et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.vacation.index') }}">Vakansiyalar</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12" >
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('back.pages.vacation.update', $vacation->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Sekmeler -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="az-tab" data-bs-toggle="tab" href="#az" role="tab" aria-controls="az" aria-selected="true">AZ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-bs-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">EN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="ru-tab" data-bs-toggle="tab" href="#ru" role="tab" aria-controls="ru" aria-selected="false">RU</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <!-- Azerice Sekmesi -->
                                    <div class="tab-pane fade show active" id="az" role="tabpanel" aria-labelledby="az-tab">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq (AZ)</label>
                                            <input type="text" name="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ $vacation->title_az }}" required>
                                            @error('title_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Açıqlama (AZ)</label>
                                            <textarea name="description_az" class="form-control @error('description_az') is-invalid @enderror" required>{{ $vacation->description_az }}</textarea>
                                            @error('description_az')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- İngilizce Sekmesi -->
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq (EN)</label>
                                            <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ $vacation->title_en }}" required>
                                            @error('title_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Açıqlama (EN)</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" required>{{ $vacation->description_en }}</textarea>
                                            @error('description_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rusça Sekmesi -->
                                    <div class="tab-pane fade" id="ru" role="tabpanel" aria-labelledby="ru-tab">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq (RU)</label>
                                            <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ $vacation->title_ru }}" required>
                                            @error('title_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Açıqlama (RU)</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" required>{{ $vacation->description_ru }}</textarea>
                                            @error('description_ru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- E-posta -->
                                <div class="mb-3">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $vacation->email }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- E-posta Metni -->
                                <div class="mb-3">
                                    <label class="form-label">E-mail Başlığı</label>
                                    <textarea name="email_text" class="form-control @error('email_text') is-invalid @enderror" required>{{ $vacation->email_text }}</textarea>
                                    @error('email_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Son Başvuru Tarihi -->
                                <div class="mb-3">
                                    <label class="form-label">Son Müraciət Tarixi</label>
                                    <input type="date" name="application_deadline" class="form-control @error('application_deadline') is-invalid @enderror" value="{{ $vacation->application_deadline }}" required>
                                    @error('application_deadline')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.vacation.index') }}" class="btn btn-secondary">Ləğv et</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 