@extends('back.layouts.master')

@section('title', 'Vacation Heroes')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Vacation Heroes</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Vacation Heroes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                @if($vacationHeroes->count() < 1)
                                    <a href="{{ route('back.pages.vacation_hero.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Yeni Vacation Hero
                                    </a>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Şəkil</th>
                                            <th>Şəkil Alt Açıklaması (AZ)</th>
                                            <th>Şəkil Alt Açıklaması (EN)</th>
                                            <th>Şəkil Alt Açıklaması (RU)</th>
                                            <th class="text-center" style="width: 150px;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vacationHeroes as $vacationHero)
                                            <tr>
                                                <td>{{ $vacationHero->id }}</td>
                                                <td>
                                                    <img src="{{ asset($vacationHero->image) }}" alt="{{ $vacationHero->image_alt_az }}" style="width: 100px; height: auto;">
                                                </td>
                                                <td>{{ $vacationHero->image_alt_az }}</td>
                                                <td>{{ $vacationHero->image_alt_en }}</td>
                                                <td>{{ $vacationHero->image_alt_ru }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('back.pages.vacation_hero.edit', $vacationHero->id) }}" 
                                                        class="btn btn-warning btn-sm" title="Düzəliş et">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            onclick="deleteData('{{ route('back.pages.vacation_hero.destroy', $vacationHero->id) }}')"
                                                            title="Sil">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Heç bir məlumat tapılmadı.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="delete-form" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
    <script>
        function deleteData(url) {
            if (confirm('Silmək istədiyinizə əminsiniz?')) {
                var form = document.getElementById('delete-form');
                form.setAttribute('action', url);
                form.submit();
            }
        }
    </script>
    @endpush
@endsection 