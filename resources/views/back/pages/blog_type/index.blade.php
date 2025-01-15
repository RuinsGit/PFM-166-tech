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
                            <div class="col-6 text-right">
                                <a href="{{ route('back.pages.blog_type.create') }}" class="btn btn-primary">Yeni Bloq Tipi</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
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
                                        <td>{{ $blog_type->id }}</td>
                                        <td>{{ $blog_type->title_az }}</td>
                                        <td>{{ $blog_type->title_en }}</td>
                                        <td>{{ $blog_type->title_ru }}</td>
                                        <td>
                                            @if($blog_type->status)
                                                <span class="badge badge-success">Aktiv</span>
                                            @else
                                                <span class="badge badge-danger">Deaktiv</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('back.pages.blog_type.edit', $blog_type->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('back.pages.blog_type.destroy', $blog_type->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
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
@endsection 