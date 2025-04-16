@extends('back.layouts.master')

@section('title', 'Sertifikatlar')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sertifikatlar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Sertifikatlar</li>
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
                                <a href="{{ route('back.pages.certificate.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            </div>

                            @if($certificates->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Şəkil</th>
                                                <th>Başlıq</th>
                                                <th>PDF</th>
                                                <th>Yaradılma tarixi</th>
                                                <th>Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($certificates as $certificate)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset($certificate->image) }}" alt="" style="max-width: 100px; max-height: 100px;">
                                                    </td>
                                                    <td>{{ $certificate->title_az }}</td>
                                                    <td>
                                                        @if($certificate->pdf)
                                                            <a href="{{ asset($certificate->pdf) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-file-pdf"></i> PDF
                                                            </a>
                                                        @else
                                                            <span class="badge bg-warning">PDF yoxdur</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $certificate->created_at->format('d.m.Y H:i') }}</td>
                                                    <td>
                                                        <a href="{{ route('back.pages.certificate.edit', $certificate->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Redaktə et
                                                        </a>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteData({{ $certificate->id }})">
                                                            <i class="fas fa-trash"></i> Sil
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination Links -->
                                <div class="row mt-3">
                                    <div class="col-12">
                                        {{ $certificates->links() }}
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
                var form = document.createElement('form');
                form.action = `{{ route('back.pages.certificate.destroy', '') }}/${id}`;
                form.method = 'POST';
                
                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                
                var tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = '{{ csrf_token() }}';
                
                form.appendChild(methodInput);
                form.appendChild(tokenInput);
                document.body.appendChild(form);
                form.submit();
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