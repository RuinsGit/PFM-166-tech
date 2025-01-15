@extends('back.layouts.master')

@section('title', 'Bloq Tipini Redaktə')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bloq Tipini Redaktə</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('back.pages.blog_type.index') }}">Bloq Tipləri</a></li>
                            <li class="breadcrumb-item active">Bloq Tipini Redaktə</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('back.pages.blog_type.update', $blog_type->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title_az">Başlıq (AZ)</label>
                                        <input type="text" name="title_az" id="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ old('title_az', $blog_type->title_az) }}" required>
                                        @error('title_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="title_en">Başlıq (EN)</label>
                                        <input type="text" name="title_en" id="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en', $blog_type->title_en) }}" required>
                                        @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="title_ru">Başlıq (RU)</label>
                                        <input type="text" name="title_ru" id="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ old('title_ru', $blog_type->title_ru) }}" required>
                                        @error('title_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 