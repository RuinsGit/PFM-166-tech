@extends('back.layouts.master')

@section('title', 'Bloq Tipləri')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bloq Tipləri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel</a></li>
                            <li class="breadcrumb-item active">Bloq Tipləri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-title">Bloq Tipləri</h3>
                            </div>
                            <div class="col-12 d-flex justify-content-end mb-4">
                                <a href="{{ route('back.pages.blog_type.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni Bloq Tipi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Başlıq (AZ)</th>
                                    <th>Başlıq (EN)</th>
                                    <th>Başlıq (RU)</th>
                                    <th>Status</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blog_types as $blog_type)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $blog_type->title_az }}</td>
                                        <td>{{ $blog_type->title_en }}</td>
                                        <td>{{ $blog_type->title_ru }}</td>
                                        <td>{{ $blog_type->status ? 'Aktiv' : 'Deaktiv' }}</td>
                                        <td>
                                            <a href="{{ route('back.pages.blog_type.edit', $blog_type->id) }}" class="btn btn-warning btn-sm">Redaktə et</a>
                                            <form action="{{ route('back.pages.blog_type.destroy', $blog_type->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">Sil</button>
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
@endsection 