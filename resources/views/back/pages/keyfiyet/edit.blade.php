@extends('back.layouts.master')

@section('title', 'Keyfiyet Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Keyfiyet Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.keyfiyet.index') }}">Keyfiyet</a></li>
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
                            <form action="{{ route('back.pages.keyfiyet.update', $keyfiyet->id) }}" method="POST">
                                @csrf
                                @method('PUT')

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
                                        <div class="mb-3">
                                            <label class="form-label">Filial Nömrəsi</label>
                                            <input type="number" name="number_filial" class="form-control" value="{{ $keyfiyet->number_filial }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Müştəri Nömrəsi</label>
                                            <input type="number" name="number_customer" class="form-control" value="{{ $keyfiyet->number_customer }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keyfiyet Nömrəsi</label>
                                            <input type="number" name="number_keyfiyet" class="form-control" value="{{ $keyfiyet->number_keyfiyet }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Filial Başlığı</label>
                                            <input type="text" name="filial_title_az" class="form-control" value="{{ $keyfiyet->filial_title_az }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Müştəri Başlığı</label>
                                            <input type="text" name="customer_title_az" class="form-control" value="{{ $keyfiyet->customer_title_az }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keyfiyet Başlığı</label>
                                            <input type="text" name="keyfiyet_title_az" class="form-control" value="{{ $keyfiyet->keyfiyet_title_az }}" required>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Başlığı</label>
                                            <input type="text" name="filial_title_en" class="form-control" value="{{ $keyfiyet->filial_title_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Müştəri Başlığı</label>
                                            <input type="text" name="customer_title_en" class="form-control" value="{{ $keyfiyet->customer_title_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keyfiyet Başlığı</label>
                                            <input type="text" name="keyfiyet_title_en" class="form-control" value="{{ $keyfiyet->keyfiyet_title_en }}" required>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Filial Başlığı</label>
                                            <input type="text" name="filial_title_ru" class="form-control" value="{{ $keyfiyet->filial_title_ru }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Müştəri Başlığı</label>
                                            <input type="text" name="customer_title_ru" class="form-control" value="{{ $keyfiyet->customer_title_ru }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keyfiyet Başlığı</label>
                                            <input type="text" name="keyfiyet_title_ru" class="form-control" value="{{ $keyfiyet->keyfiyet_title_ru }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.keyfiyet.index') }}" class="btn btn-secondary">Ləğv et</a>
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