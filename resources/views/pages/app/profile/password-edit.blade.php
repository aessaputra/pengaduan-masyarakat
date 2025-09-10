@extends('layouts.app')

@section('title', 'Ubah Kata Sandi')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Ubah Kata Sandi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        id="current_password" name="current_password" required>
                    @error('current_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>

                {{-- Tombol Submit --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('profile') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Kata Sandi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
