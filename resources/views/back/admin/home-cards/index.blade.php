@extends('back.layouts.master')

@section('title', 'Hero')

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
                        <h4 class="mb-sm-0">Hero</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Hero</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Home Cards</h4>
                            @if($cardCount < 1)
                                <a href="{{ route('back.pages.home-cards.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni Yarat
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($cardCount > 0)
                                <div class="alert alert-warning w-50 ms-auto">
                                    Hal hazırda {{ $cardCount }} ədəd Home Card mövcuddur.
                                </div>
                            @else
                                <div class="alert alert-warning w-50 ms-auto">
                                    Hal hazırda heç bir Home Card mövcud deyil. Yeni Home Card yaratmaq üçün yuxarıdakı "Yeni" düyməsini istifadə edin.
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Şəkil</th>
                                            <th>Başlıq (AZ)</th>
                                            <th>Təsvir (AZ)</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($homeCards as $card)
                                            <tr>
                                                <td>
                                                    <div class="image-preview">
                                                        <img src="{{ asset($card->image) }}" alt="{{ $card->image_alt_az }}" class="card-img" style="width: 100px; height: auto;">
                                                    </div>
                                                </td>
                                                <td>{{ $card->title_az }}</td>
                                                <td>{{ Str::limit($card->description_az, 100) }}</td>
                                                <td>
                                                    <a href="{{ route('back.pages.home-cards.edit', $card->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i> Redaktə Et
                                                    </a>
                                                    <form action="{{ route('back.pages.home-cards.destroy', $card->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu kartı silmək istədiyinizə əminsiniz?')">
                                                            <i class="fas fa-trash"></i> Sil
                                                        </button>
                                                    </form>
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

    .nav-tabs {
        border-bottom: 2px solid #eee;
        margin-bottom: 20px;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 12px 20px;
        transition: all 0.2s ease;
    }

    .nav-tabs .nav-link.active {
        color: #2c3e50;
        border-bottom: 2px solid #3498db;
        background: transparent;
    }

    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #3498db;
    }

    .form-label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
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

    .btn-secondary {
        background-color: #95a5a6;
        border-color: #95a5a6;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
        border-color: #7f8c8d;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .tab-content {
        padding: 20px;
        background-color: #fff;
        border-radius: 0 0 8px 8px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .image-preview {
            width: 80px;
            height: 80px;
        }
        
        .nav-tabs .nav-link {
            padding: 8px 12px;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection 