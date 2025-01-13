@extends('back.layouts.master')

@section('title', 'Portfolio')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Portfolio</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Portfolio</li>
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
                                <a href="{{ route('back.pages.portfolio.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Yeni Portfolio
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center" style="width: 100px;">Şəkil</th>
                                            <th>Başlıq (AZ)</th>
                                            <th>Başlıq (EN)</th>
                                            <th>Başlıq (RU)</th>
                                            <th class="text-center" style="width: 150px;">Alt Şəkillər</th>
                                            <th class="text-center" style="width: 150px;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($portfolios as $portfolio)
                                            <tr>
                                                <td class="text-center">
                                                    @if($portfolio->main_image)
                                                        <img src="{{ asset($portfolio->main_image) }}" alt="{{ $portfolio->main_image_alt_az }}" 
                                                            class="img-fluid rounded" style="max-height: 50px;">
                                                    @else
                                                        <span class="text-muted">Şəkil yoxdur</span>
                                                    @endif
                                                </td>
                                                <td>{{ $portfolio->title_az }}</td>
                                                <td>{{ $portfolio->title_en }}</td>
                                                <td>{{ $portfolio->title_ru }}</td>
                                                <td class="text-center">
                                                    @if($portfolio->bottom_images)
                                                        @php
                                                            $bottomImages = json_decode($portfolio->bottom_images);
                                                            $imageCount = count($bottomImages);
                                                        @endphp
                                                        <span class="badge bg-info">{{ $imageCount }} şəkil</span>
                                                    @else
                                                        <span class="badge bg-secondary">0 şəkil</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('back.pages.portfolio.edit', $portfolio->id) }}" 
                                                        class="btn btn-warning btn-sm" title="Düzəlt">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <form action="{{ route('back.pages.portfolio.destroy', $portfolio->id) }}" 
                                                        method="POST" class="d-inline-block" onsubmit="return confirm('Silmək istədiyinizə əminsiniz?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Sil">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
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
@endsection

@push('css')
<style>
    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endpush 