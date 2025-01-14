@extends('back.layouts.master')

@section('title', 'Karyera Qəhrəmanları')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Karyera Qəhrəmanları</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Karyera Qəhrəmanları</li>
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
                                @if($careerHeroes->count() < 1)
                                    <a href="{{ route('back.pages.career_hero.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Yeni Karyera Qəhrəmanı
                                    </a>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Şəkil</th>
                                            <th>Məzmun (AZ)</th>
                                            <th>Məzmun (EN)</th>
                                            <th>Məzmun (RU)</th>
                                            <th>Video</th>
                                            <th class="text-center" style="width: 150px;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($careerHeroes as $careerHero)
                                            <tr>
                                                <td>{{ $careerHero->id }}</td>
                                                <td>
                                                    <img src="{{ asset($careerHero->image) }}" alt="" style="width: 100px; height: auto;">
                                                </td>
                                                <td>{{ $careerHero->description_az }}</td>
                                                <td>{{ $careerHero->description_en }}</td>
                                                <td>{{ $careerHero->description_ru }}</td>
                                                <td>
                                                    @if($careerHero->video)
                                                        <video width="100" height="auto" controls>
                                                            <source src="{{ asset($careerHero->video) }}" type="video/mp4">
                                                            Brauzeriniz video təqini dəstəkləmir.
                                                        </video>
                                                    @else
                                                        Video yoxdur
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('back.pages.career_hero.edit', $careerHero->id) }}" 
                                                        class="btn btn-warning btn-sm" title="Düzəliş et">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            onclick="deleteData('{{ route('back.pages.career_hero.destroy', $careerHero->id) }}')"
                                                            title="Sil">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Heç bir məlumat tapılmadı.</td>
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