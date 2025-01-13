@extends('back.layouts.master')

@section('title', 'Portfolio Types')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Portfolio Types</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Portfolio Types</li>
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
                                <a href="{{ route('back.pages.portfolio_type.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            </div>

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
                                    @foreach($portfolioTypes as $portfolioType)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $portfolioType->title_az }}</td>
                                            <td>{{ $portfolioType->title_en }}</td>
                                            <td>{{ $portfolioType->title_ru }}</td>
                                            <td>{{ $portfolioType->status ? 'Aktiv' : 'Deaktiv' }}</td>
                                            <td>
                                                <a href="{{ route('back.pages.portfolio_type.edit', $portfolioType->id) }}" class="btn btn-warning btn-sm">Redaktə et</a>
                                                <form action="{{ route('back.pages.portfolio_type.destroy', $portfolioType->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Sil</button>
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