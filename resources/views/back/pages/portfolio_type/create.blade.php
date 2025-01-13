@extends('back.layouts.master')

@section('title', 'Yeni Portfolio Type')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Portfolio Type</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.portfolio_type.index') }}">Portfolio Types</a></li>
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
                            <form action="{{ route('back.pages.portfolio_type.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Başlıq (AZ)</label>
                                    <input type="text" name="title_az" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Başlıq (EN)</label>
                                    <input type="text" name="title_en" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Başlıq (RU)</label>
                                    <input type="text" name="title_ru" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Aktiv</option>
                                        <option value="0">Deaktiv</option>
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