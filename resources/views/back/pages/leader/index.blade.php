@extends('back.layouts.master')

@section('title', 'Komandamız')

@section('content')
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "{{ session('success') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'Tamam',
                    timer: 1500
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "{{ session('error') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'Tamam',
                    timer: 1500
                });
            });
        </script>
    @endif

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Komandamız</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Komandamız</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Komandamız Siyahısı</h4>
                            <a href="{{ route('back.pages.leaders.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Yeni Yarat
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Şəkil</th>
                                            <th>Ad Soyad</th>
                                            <th>Vəzifə (AZ)</th>
                                            <th>Status</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leaders as $leader)
                                            <tr>
                                                <td>
                                                    <div class="image-preview">
                                                        <img src="{{ asset($leader->image) }}" alt="Leader" class="card-img">
                                                    </div>
                                                </td>
                                                <td>{{ $leader->name }} {{ $leader->surname }}</td>
                                                <td>{{ $leader->position_az }}</td>
                                                <td>
                                                    <button type="button" 
                                                            class="btn status-button {{ $leader->status ? 'btn-success' : 'btn-danger' }}"
                                                            onclick="changeStatus({{ $leader->id }})"
                                                            data-id="{{ $leader->id }}">
                                                        {{ $leader->status ? 'Aktiv' : 'Deaktiv' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('back.pages.leaders.edit', $leader->id) }}" 
                                                       class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Redaktə et
                                                    </a>
                                                    <button class="btn btn-danger btn-sm" 
                                                            onclick="deleteItem({{ $leader->id }})">
                                                        <i class="fas fa-trash"></i> Sil
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .image-preview {
        width: 100px;
        height: 100px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin: 0 auto;
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

    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        border-radius: 12px;
        overflow: hidden;
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
        .image-preview {
            width: 80px;
            height: 80px;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
    </style>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'Silmək istədiyinizdən əminsiniz?',
                text: "Bu əməliyyat geri alına bilməz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, sil!',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ route('back.pages.leaders.destroy', '') }}/${id}`;
                }
            });
        }

        function changeStatus(id) {
            $.ajax({
                url: "{{ route('back.pages.leaders.status', '') }}/" + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        let button = $(`.status-button[data-id="${id}"]`);
                        if (response.status) {
                            button.removeClass('btn-danger').addClass('btn-success');
                            button.text('Aktiv');
                        } else {
                            button.removeClass('btn-success').addClass('btn-danger');
                            button.text('Deaktiv');
                        }

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Xəta',
                        text: 'Status dəyişdirilmədi'
                    });
                }
            });
        }
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Uğur',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Xəta',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endpush 