@extends('layouts.admin')

@section('title', 'Edit Data Masyarakat')

@section('content')
    <a href="{{ route('admin.resident.index') }}" class="btn btn-danger mb-3">Kembali</a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.resident.update', $resident->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $resident->user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $resident->user->email) }}" readonly>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password">
                    {{-- Tambahkan helper text untuk menginformasikan bahwa password opsional --}}
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Foto Profile Saat Ini</label>
                    <div>
                        @if ($resident->avatar)
                            @if (Str::isUrl($resident->avatar))
                                <img src="{{ $resident->avatar }}" referrerpolicy="no-referrer" alt="avatar"
                                    class="rounded" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/' . $resident->avatar) }}" alt="avatar" class="rounded"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="avatar" class="rounded"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="avatar">Ganti Foto Profile</label>
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar"
                        name="avatar">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
