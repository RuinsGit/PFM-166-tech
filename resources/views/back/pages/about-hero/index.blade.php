@extends('back.layouts.master')

@section('title', 'About Hero')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">About Hero</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">About Hero</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 d-flex justify-content-end mb-4">
                                @if(!$aboutHero)
                                    <a href="{{ route('back.pages.about-hero.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                @endif
                            </div>

                            @if($aboutHero)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Şəkil</th>
                                                <th>ALT (AZ)</th>
                                                <th>ALT (EN)</th>
                                                <th>ALT (RU)</th>
                                                <th>Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($aboutHero->image) }}" alt="" 
                                                         style="max-width: 100px; max-height: 100px;">
                                                </td>
                                                <td>{{ $aboutHero->image_alt_az }}</td>
                                                <td>{{ $aboutHero->image_alt_en }}</td>
                                                <td>{{ $aboutHero->image_alt_ru }}</td>
                                                <td>
                                                    <a href="{{ route('back.pages.about-hero.edit', $aboutHero->id) }}" 
                                                       class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Redaktə et
                                                    </a>
                                                    <button class="btn btn-danger btn-sm" 
                                                            onclick="deleteData({{ $aboutHero->id }})">
                                                        <i class="fas fa-trash"></i> Sil
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Təsvirlər Bölməsi -->
                                <div class="mt-4">
                                    <h5>Təsvirlər</h5>
                                    <ul class="nav nav-tabs nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">AZ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">EN</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">RU</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content p-3">
                                        <div class="tab-pane active" id="az" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Təsvir 1:</h6>
                                                    {!! $aboutHero->description1_az !!}
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Təsvir 2:</h6>
                                                    {!! $aboutHero->description2_az !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="en" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Description 1:</h6>
                                                    {!! $aboutHero->description1_en !!}
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Description 2:</h6>
                                                    {!! $aboutHero->description2_en !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="ru" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Описание 1:</h6>
                                                    {!! $aboutHero->description1_ru !!}
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Описание 2:</h6>
                                                    {!! $aboutHero->description2_ru !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <p>Məlumat tapılmadı.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteData(id) {
        Swal.fire({
            title: 'Əminsiniz?',
            text: "Bu məlumatı silmək istədiyinizə əminsiniz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Bəli, sil!',
            cancelButtonText: 'Xeyr'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `{{ route('back.pages.about-hero.destroy', '') }}/${id}`;
            }
        });
    }
</script>

@if(session('success'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@endpush 