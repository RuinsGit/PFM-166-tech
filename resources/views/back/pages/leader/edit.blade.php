@extends('back.layouts.master')

@section('title', 'Lideri Redaktə Et')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Lideri Redaktə Et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.leaders.index') }}">Liderlər</a></li>
                                <li class="breadcrumb-item active">Redaktə Et</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('back.pages.leaders.update', $leader->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="name">Ad</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $leader->name) }}" required>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="surname">Soyad</label>
                                        <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname', $leader->surname) }}" required>
                                        @error('surname')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="position_az">Vəzifə (AZ)</label>
                                        <input type="text" class="form-control" id="position_az" name="position_az" value="{{ old('position_az', $leader->position_az) }}" required>
                                        @error('position_az')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="position_en">Vəzifə (EN)</label>
                                        <input type="text" class="form-control" id="position_en" name="position_en" value="{{ old('position_en', $leader->position_en) }}">
                                        @error('position_en')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="position_ru">Vəzifə (RU)</label>
                                        <input type="text" class="form-control" id="position_ru" name="position_ru" value="{{ old('position_ru', $leader->position_ru) }}">
                                        @error('position_ru')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="image">Şəkil</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @if($leader->image)
                                            <div class="image-preview mt-2">
                                                <img src="{{ asset($leader->image) }}" alt="Leader" class="card-img">
                                            </div>
                                        @endif
                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="status">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="1" {{ old('status', $leader->status) == 1 ? 'selected' : '' }}>Aktiv</option>
                                            <option value="0" {{ old('status', $leader->status) == 0 ? 'selected' : '' }}>Deaktiv</option>
                                        </select>
                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Yadda saxla
                                        </button>
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
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        border-radius: 12px;
        overflow: hidden;
    }

    .form-label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .image-preview {
        width: 150px;
        height: 150px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
    }

    .image-preview:hover .card-img {
        transform: scale(1.05);
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

    @media (max-width: 768px) {
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .image-preview {
            width: 100px;
            height: 100px;
        }
    }
    </style>
@endsection 