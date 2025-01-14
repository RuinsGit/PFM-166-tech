@extends('back.layouts.master')

@section('title', 'Müraciət Detayı')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Müraciət Detayı</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('back.pages.contact_requests.index') }}">Müraciətlər</a></li>
                        <li class="breadcrumb-item active">Müraciət Detayı</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th style="width: 200px">Ad:</th>
                                    <td>{{ $contactRequest->name }}</td>
                                </tr>
                                <tr>
                                    <th>E-poçt:</th>
                                    <td>{{ $contactRequest->email }}</td>
                                </tr>
                                <tr>
                                    <th>Nömrə:</th>
                                    <td>{{ $contactRequest->number }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($contactRequest->status === 'Yeni')
                                            <span class="badge badge-success">{{ $contactRequest->status }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $contactRequest->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tarix:</th>
                                    <td>{{ $contactRequest->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-12 mt-4">
                            <h5>Məzmun:</h5>
                            <div class="border rounded p-3">
                                {{ $contactRequest->description }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('back.pages.contact_requests.index') }}" class="btn btn-secondary">Geri</a>
                        <button type="button" class="btn btn-danger" onclick="deleteRequest({{ $contactRequest->id }})">Sil</button>
                        <form id="delete-form-{{ $contactRequest->id }}" action="{{ route('back.pages.contact_requests.destroy', $contactRequest->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function deleteRequest(id) {
        if (confirm('Silmək istədiyinizə əminsiniz?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush 