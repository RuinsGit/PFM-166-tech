@extends('back.layouts.master')

@section('title', 'Portfolio Type Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Portfolio Type Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.portfolio_type.index') }}">Portfolio Types</a></li>
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
                            <form action="{{ route('back.pages.portfolio_type.update', $portfolioType->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Başlıq (AZ)</label>
                                    <input type="text" name="title_az" class="form-control" value="{{ $portfolioType->title_az }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Başlıq (EN)</label>
                                    <input type="text" name="title_en" class="form-control" value="{{ $portfolioType->title_en }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Başlıq (RU)</label>
                                    <input type="text" name="title_ru" class="form-control" value="{{ $portfolioType->title_ru }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $portfolioType->status == 1 ? 'selected' : '' }}>Aktiv</option>
                                        <option value="0" {{ $portfolioType->status == 0 ? 'selected' : '' }}>Deaktiv</option>
                                    </select>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.portfolio_type.index') }}" class="btn btn-secondary">Ləğv et</a>
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