@extends('layouts.no-nav')

@section('title', 'Preview Foto')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 85vh;">
        <img alt="image" id="image-preview" class="img-fluid rounded-2 mb-4"
            style="max-height: 70vh; background-color: #f0f0f0;">

        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('report.take') }}" class="btn btn-outline-primary">
                Ulangi Foto
            </a>
            <a href="{{ route('report.create') }}" class="btn btn-primary">
                Gunakan Foto
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const keyPenyimpanan = 'fotoLaporan';
            const imagePreview = document.getElementById('image-preview');

            const imageData = sessionStorage.getItem(keyPenyimpanan);

            if (imageData) {
                imagePreview.src = imageData;
            } else {
                alert('Gagal memuat foto. Silakan ulangi.');
                window.location.href = "{{ route('report.take') }}";
            }
        });
    </script>
@endsection
