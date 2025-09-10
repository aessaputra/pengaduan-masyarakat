@extends('layouts.admin')

@section('title', 'Detail Masyarakat')

@section('content')
    <a href="{{ route('admin.resident.index') }}" class="btn btn-danger mb-3">Kembali</a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Masyarakat</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Nama</td>
                    <td>{{ $resident->user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $resident->user->email }}</td>
                </tr>
                <tr>
                    <td>Foto Profile</td>
                    <td>
                        @if ($resident->avatar)
                            @if (Str::isUrl($resident->avatar))
                                <img src="{{ $resident->avatar }}" referrerpolicy="no-referrer" alt="avatar" class="rounded"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/' . $resident->avatar) }}" alt="avatar" class="rounded"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="avatar" class="rounded"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
