@extends('back.layouts.master')

@section('title', 'Yeni Vacation Hero')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Vacation Hero</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.vacation_hero.index') }}">Vacation Heroes</a></li>
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
                            <form action="{{ route('back.pages.vacation_hero.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!--�əkil -->
                                <div class="mb-3">
                                    <label class="form-label">Şəkil</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Şəkil Alt Açıklaması (AZ) -->
                                <div class="mb-3">
                                    <label class="form-label">Şəkil Alt Açıklaması (AZ)</label>
                                    <input type="text" name="image_alt_az" class="form-control @error('image_alt_az') is-invalid @enderror" required>
                                    @error('image_alt_az')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Şəkil Alt Açıklaması (EN) -->
                                <div class="mb-3">
                                    <label class="form-label">Şəkil Alt Açıklaması (EN)</label>
                                    <input type="text" name="image_alt_en" class="form-control @error('image_alt_en') is-invalid @enderror" required>
                                    @error('image_alt_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Şəkil Alt Açıklaması (RU) -->
                                <div class="mb-3">
                                    <label class="form-label">Şəkil Alt Açıklaması (RU)</label>
                                    <input type="text" name="image_alt_ru" class="form-control @error('image_alt_ru') is-invalid @enderror" required>
                                    @error('image_alt_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.vacation_hero.index') }}" class="btn btn-secondary">Ləğv et</a>
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