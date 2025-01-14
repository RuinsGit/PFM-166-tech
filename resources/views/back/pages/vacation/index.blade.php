@extends('back.layouts.master')

@section('title', 'Vacations')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Vakansiyalar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Vakansiyalar</li>
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
                                <a href="{{ route('back.pages.vacation.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Yeni Vakansiya
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Başlıq (AZ)</th>
                                           
                                            <th>Açıqlama (AZ)</th>
                                                    
                                            <th>E-mail</th>
                                             
                                            <th>Son Müraciət Tarixi</th>
                                            <th>Görüntüleme Sayısı</th>
                                            <th class="text-center" style="width: 150px;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vacations as $vacation)
                                            <tr>
                                                <td>{{ $vacation->id }}</td>
                                                <td>{{ $vacation->title_az }}</td>
                                                
                                                <td>{{ $vacation->description_az }}</td>
                                              
                                                <td>{{ $vacation->email }}</td>
                                               
                                                <td>{{ $vacation->application_deadline }}</td>
                                                <td>{{ $vacation->view_count }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('back.pages.vacation.edit', $vacation->id) }}" 
                                                        class="btn btn-warning btn-sm" title="Düzəliş et">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            onclick="deleteData('{{ route('back.pages.vacation.destroy', $vacation->id) }}')"
                                                            title="Sil">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">Heç bir məlumat tapılmadı.</td>
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