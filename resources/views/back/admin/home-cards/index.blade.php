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
                        <div class="card-body">
                            <div class="col-12">
                                <div class="d-flex justify-content-end mb-4">
                                    @if($cardCount === 0)
                                        <a href="{{ route('back.pages.home-cards.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Yeni Hero
                                        </a>
                                    @else
                                        <div class="alert alert-warning">
                                            Hal hazırda home card mövcuddur. yeni home card yaratmaq üçün əvvəlcə əvvəlcəki home cardı silin ya da redaktə edin.
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Şəkil</th>
                                        <th>Başlıq (AZ)</th>
                                        <th>Təsvir (AZ)</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($homeCards as $card)
                                        <tr>
                                            <td>{{ $card->id }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $card->image) }}" 
                                                    alt="{{ $card->image_alt_az }}" 
                                                    style="max-width: 100px;">
                                            </td>
                                            <td>{{ $card->title_az }}</td>
                                            <td>{{ Str::limit($card->description_az, 50) }}</td>
                                            <td>
                                                <a href="{{ route('back.pages.home-cards.edit', $card->id) }}" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <form action="{{ route('back.pages.home-cards.destroy', $card->id) }}" 
                                                      method="POST" 
                                                      class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                                        <i class="fas fa-trash"></i>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection 