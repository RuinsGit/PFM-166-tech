@extends('back.layouts.master')

@section('title', 'About Section')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">About Section</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">About Section</li>
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
                                <a href="{{ route('back.pages.about-section.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            </div>

                            @if($aboutSections->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Şəkil</th>
                                                <th>Başlıq (AZ)</th>
                                                <th>Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($aboutSections as $aboutSection)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset($aboutSection->image) }}" alt="" 
                                                             style="max-width: 100px; max-height: 100px;">
                                                    </td>
                                                    <td>{{ $aboutSection->title_az }}</td>
                                                    <td>
                                                        <a href="{{ route('back.pages.about-section.edit', $aboutSection->id) }}" 
                                                           class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Redaktə et
                                                        </a>
                                                        <button class="btn btn-danger btn-sm" 
                                                                onclick="deleteData({{ $aboutSection->id }})">
                                                            <i class="fas fa-trash"></i> Sil
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                window.location.href = `{{ route('back.pages.about-section.destroy', '') }}/${id}`;
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