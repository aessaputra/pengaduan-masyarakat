@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex flex-column justify-content-center align-items-center gap-2">
        @if (Auth::user()->resident && Auth::user()->resident->avatar)

            @if (Str::isUrl(Auth::user()->resident->avatar))
                <img src="{{ Auth::user()->resident->avatar }}" referrerpolicy="no-referrer" alt="avatar"
                    class="avatar rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
            @else
                <img src="{{ asset('storage/' . Auth::user()->resident->avatar) }}" alt="avatar"
                    class="avatar rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
            @endif
        @else
            <img src="{{ asset('images/default-avatar.png') }}" alt="avatar" class="avatar rounded-circle"
                style="width: 100px; height: 100px; object-fit: cover;">
        @endif
        <h5 class="mt-2">{{ Auth::user()->name }}</h5>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-6">
            <div class="card profile-stats">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $activeReportsCount }}</h5>
                    <p class="card-text text-nowrap">Laporan Aktif</p>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card profile-stats">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $completedReportsCount }}</h5>
                    <p class="card-text text-nowrap">Laporan Selesai</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="list-group list-group-flush">
            <a href="{{ route('profile.edit') }}"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <i class="fa-solid fa-user"></i>
                    <p class="fw-light mb-0">Pengaturan Akun</p>
                </div>
                <i class="fa-solid fa-chevron-right"></i>
            </a>
            @if (Auth::user()->password)
                <a href="{{ route('password.edit') }}"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-lock"></i>
                        <p class="fw-light mb-0">Kata sandi</p>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            @endif
            <a href="{{ route('help.index') }}"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <i class="fa-solid fa-question-circle"></i>
                    <p class="fw-light mb-0">Bantuan dan dukungan</p>
                </div>
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>

        <div class="mt-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <button class="btn btn-outline-danger w-100 rounded-pill"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Keluar
            </button>
        </div>
    </div>
@endsection
