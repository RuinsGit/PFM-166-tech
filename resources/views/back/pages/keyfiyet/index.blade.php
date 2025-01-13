@extends('back.layouts.master')
@use('App\Models\Keyfiyet')

@section('title', 'Keyfiyet')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Keyfiyet</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Keyfiyet</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(Keyfiyet::count() >= 1)
                                <div class="alert alert-warning">
                                    Hal-hazırda bir keyfiyet mövcuddur. Yeni bir keyfiyet əlavə edə bilməzsiniz.
                                </div>
                            @else
                                <div class="col-12 d-flex justify-content-end mb-4">
                                    <a href="{{ route('back.pages.keyfiyet.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($keyfiyets->count() > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Filial Nömrəsi</th>
                                            <th>Müştəri Nömrəsi</th>
                                            <th>Keyfiyet Nömrəsi</th>
                                            <th>Filial Başlığı</th>
                                            <th>Müştəri Başlığı</th>
                                            <th>Keyfiyet Başlığı</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($keyfiyets as $keyfiyet)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $keyfiyet->number_filial }}</td>
                                                <td>{{ $keyfiyet->number_customer }}</td>
                                                <td>{{ $keyfiyet->number_keyfiyet }}</td>
                                                <td>{{ $keyfiyet->filial_title_az }}</td>
                                                <td>{{ $keyfiyet->customer_title_az }}</td>
                                                <td>{{ $keyfiyet->keyfiyet_title_az }}</td>
                                                <td>
                                                    <a href="{{ route('back.pages.keyfiyet.edit', $keyfiyet->id) }}" class="btn btn-warning btn-sm">Redaktə et</a>
                                                    <form action="{{ route('back.pages.keyfiyet.destroy', $keyfiyet->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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