@extends('back.layouts.master')

@section('title', 'Müraciətlər')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Müraciətlər</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel</a></li>
                        <li class="breadcrumb-item active">Müraciətlər</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px">ID</th>
                                <th>Ad</th>
                                <th>E-poçt</th>
                                <th>Nömrə</th>
                                <th>Məzmun</th>
                                <th>Status</th>
                                <th>Tarix</th>
                                <th style="width: 200px">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contactRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->number }}</td>
                                <td>{{ Str::limit($request->description, 50) }}</td>
                                <td>
                                    @if($request->status === 'Yeni')
                                        <span class="badge badge-success">{{ $request->status }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $request->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('back.pages.contact_requests.show', $request->id) }}" class="btn btn-sm btn-info">Bax</a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteRequest({{ $request->id }})">Sil</button>
                                    <form id="delete-form-{{ $request->id }}" action="{{ route('back.pages.contact_requests.destroy', $request->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
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

@push('js')
<script>
    function deleteRequest(id) {
        if (confirm('Silmək istədiyinizə əminsiniz?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush 