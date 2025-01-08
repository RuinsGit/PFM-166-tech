@extends('back.layouts.master')

@section('title', 'Logolar')

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
                        <h4 class="mb-sm-0">Logolar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Logolar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 d-flex justify-content-end mb-4">
                                @if($logoCount === 0)
                                    <a href="{{ route('back.pages.logos.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                @else
                                    <div class="alert alert-warning">
                                        Hal hazırda logo mövcuddur. yeni logo yaratmaq üçün əvvəlcə əvvəlcəki logo'nu silin. ya da redaktə edin.
                                    </div>
                                @endif
                            </div>

                            <ul class="nav nav-tabs nav-tabs-custom nav-justified mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block" style=" color: #ff8a33;">AZ</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block" style=" color: #ff8a33;">EN</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block" style=" color: #ff8a33;">RU</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Logo 1</th>
                                                    <th>Logo 1 Başlığı (AZ)</th>
                                                    <th>Logo 1 Altı (AZ)</th>
                                                    <th>Logo 2</th>
                                                    <th>Logo 2 Başlığı (AZ)</th>
                                                    <th>Logo 2 Altı (AZ)</th>
                                                    <th>Status</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($logos as $logo)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><img src="{{ asset($logo->logo_1_image) }}" alt="Logo 1" width="100"></td>
                                                        <td>{{ $logo->logo_title1_az }}</td>
                                                        <td>{{ $logo->logo_alt1_az }}</td>
                                                        <td><img src="{{ asset($logo->logo_2_image) }}" alt="Logo 2" width="100"></td>
                                                        <td>{{ $logo->logo_title2_az }}</td>
                                                        <td>{{ $logo->logo_alt2_az }}</td>
                                                        <td>
                                                            {{ $logo->status ?? 1 == 1 ? 'Aktif' : 'Deaktif' }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('back.pages.logos.edit', $logo->id) }}" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $logo->id }}" action="{{ route('back.pages.logos.destroy', $logo->id) }}" method="POST" class="d-none">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <button class="btn btn-danger btn-sm" onclick="deleteData({{ $logo->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Logo 1</th>
                                                    <th>Logo 1 Başlığı (EN)</th>
                                                    <th>Logo 1 Altı (EN)</th>
                                                    <th>Logo 2</th>
                                                    <th>Logo 2 Başlığı (EN)</th>
                                                    <th>Logo 2 Altı (EN)</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($logos as $logo)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><img src="{{ asset($logo->logo_1_image) }}" alt="Logo 1" width="100"></td>
                                                        <td>{{ $logo->logo_title1_en }}</td>
                                                        <td>{{ $logo->logo_alt1_en }}</td>
                                                        <td><img src="{{ asset($logo->logo_2_image) }}" alt="Logo 2" width="100"></td>
                                                        <td>{{ $logo->logo_title2_en }}</td>
                                                        <td>{{ $logo->logo_alt2_en }}</td>
                                                        <td>
                                                            {{ $logo->status ?? 1 == 1 ? 'Aktif' : 'Deaktif' }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('back.pages.logos.edit', $logo->id) }}" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $logo->id }}" action="{{ route('back.pages.logos.destroy', $logo->id) }}" method="POST" class="d-none">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <button class="btn btn-danger btn-sm" onclick="deleteData({{ $logo->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Logo 1</th>
                                                    <th>Logo 1 Başlığı (RU)</th>
                                                    <th>Logo 1 Altı (RU)</th>
                                                    <th>Logo 2</th>
                                                    <th>Logo 2 Başlığı (RU)</th>
                                                    <th>Logo 2 Altı (RU)</th>
                                                    <th>Status</th>
                                                    <th>Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($logos as $logo)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><img src="{{ asset($logo->logo_1_image) }}" alt="Logo 1" width="100"></td>
                                                        <td>{{ $logo->logo_title1_ru }}</td>
                                                        <td>{{ $logo->logo_alt1_ru }}</td>
                                                        <td><img src="{{ asset($logo->logo_2_image) }}" alt="Logo 2" width="100"></td>
                                                        <td>{{ $logo->logo_title2_ru }}</td>
                                                        <td>{{ $logo->logo_alt2_ru }}</td>
                                                        <td>
                                                            {{ $logo->status ?? 1 == 1 ? 'Aktif' : 'Deaktif' }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('back.pages.logos.edit', $logo->id) }}" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $logo->id }}" action="{{ route('back.pages.logos.destroy', $logo->id) }}" method="POST" class="d-none">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <button class="btn btn-danger btn-sm" onclick="deleteData({{ $logo->id }})">
                                                                <i class="fas fa-trash"></i>
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
        </div>
    </div>
@endsection

@push('js')
<script>
    function deleteData(id) {
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
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    $(document).ready(function() {
        $('.table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
            }
        });
    });
</script>
@endpush 