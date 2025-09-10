@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Pengaturan Akun</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', Auth::user()->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="avatar" class="form-label">Ganti Foto Profil</label>
                    <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar"
                        name="avatar">
                    <div class="form-text">Kosongkan jika tidak ingin mengubah foto. (Maks: 2MB)</div>
                    @error('avatar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('profile') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
