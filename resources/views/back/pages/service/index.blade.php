@extends('back.layouts.master')

@section('title', 'Services')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Services</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Services</li>
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
                                <a href="{{ route('back.pages.service.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            </div>

                            @if($services->count() > 0)
                                @foreach($services as $service)
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title">Service #{{ $loop->iteration }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#az{{ $service->id }}" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">AZ</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#en{{ $service->id }}" role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                        <span class="d-none d-sm-block">EN</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#ru{{ $service->id }}" role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                        <span class="d-none d-sm-block">RU</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content p-3">
                                                <!-- AZ Tab -->
                                                <div class="tab-pane active" id="az{{ $service->id }}" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="200">Şəkil</td>
                                                                    <td>
                                                                        <img src="{{ asset($service->image) }}" alt="" 
                                                                             style="max-width: 100px; max-height: 100px;">
                                                                        <p class="mt-1">ALT: {{ $service->image_alt_az }}</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alt Şəkil</td>
                                                                    <td>
                                                                        <img src="{{ asset($service->bottom_image) }}" alt="" 
                                                                             style="max-width: 100px; max-height: 100px;">
                                                                        <p class="mt-1">ALT: {{ $service->bottom_image_alt_az }}</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Meta Title</td>
                                                                    <td>{{ $service->meta_title_az }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Meta Description</td>
                                                                    <td>{{ $service->meta_description_az }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Başlıq 1</td>
                                                                    <td>{{ $service->title1_az }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mətn 1</td>
                                                                    <td>{!! $service->text1_az !!}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Başlıq 2</td>
                                                                    <td>{{ $service->title2_az }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mətn 2</td>
                                                                    <td>{!! $service->text2_az !!}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- EN Tab -->
                                                <div class="tab-pane" id="en{{ $service->id }}" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="200">Image</td>
                                                                    <td>
                                                                        <img src="{{ asset($service->image) }}" alt="" 
                                                                             style="max-width: 100px; max-height: 100px;">
                                                                        <p class="mt-1">ALT: {{ $service->image_alt_en }}</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bottom Image</td>
                                                                    <td>
                                                                        <img src="{{ asset($service->bottom_image) }}" alt="" 
                                                                             style="max-width: 100px; max-height: 100px;">
                                                                        <p class="mt-1">ALT: {{ $service->bottom_image_alt_en }}</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Meta Title</td>
                                                                    <td>{{ $service->meta_title_en }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Meta Description</td>
                                                                    <td>{{ $service->meta_description_en }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Title 1</td>
                                                                    <td>{{ $service->title1_en }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Text 1</td>
                                                                    <td>{!! $service->text1_en !!}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Title 2</td>
                                                                    <td>{{ $service->title2_en }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Text 2</td>
                                                                    <td>{!! $service->text2_en !!}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- RU Tab -->
                                                <div class="tab-pane" id="ru{{ $service->id }}" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="200">Изображение</td>
                                                                    <td>
                                                                        <img src="{{ asset($service->image) }}" alt="" 
                                                                             style="max-width: 100px; max-height: 100px;">
                                                                        <p class="mt-1">ALT: {{ $service->image_alt_ru }}</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Нижнее Изображение</td>
                                                                    <td>
                                                                        <img src="{{ asset($service->bottom_image) }}" alt="" 
                                                                             style="max-width: 100px; max-height: 100px;">
                                                                        <p class="mt-1">ALT: {{ $service->bottom_image_alt_ru }}</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Meta Title</td>
                                                                    <td>{{ $service->meta_title_ru }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Meta Description</td>
                                                                    <td>{{ $service->meta_description_ru }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Заголовок 1</td>
                                                                    <td>{{ $service->title1_ru }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Текст 1</td>
                                                                    <td>{!! $service->text1_ru !!}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Заголовок 2</td>
                                                                    <td>{{ $service->title2_ru }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Текст 2</td>
                                                                    <td>{!! $service->text2_ru !!}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <a href="{{ route('back.pages.service.edit', $service->id) }}" 
                                                   class="btn btn-warning">
                                                    <i class="fas fa-edit"></i> Redaktə et
                                                </a>
                                                <button class="btn btn-danger" onclick="deleteData({{ $service->id }})">
                                                    <i class="fas fa-trash"></i> Sil
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                window.location.href = `{{ route('back.pages.service.destroy', '') }}/${id}`;
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
