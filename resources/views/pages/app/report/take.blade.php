@extends('layouts.no-nav')

@section('title', 'Ambil Foto')

@section('content')
    <div class="container text-center d-flex flex-column justify-content-center" style="height: 80vh;">
        <h3 class="mb-3">Ambil Foto Laporan</h3>
        <p>Klik tombol di bawah untuk membuka kamera perangkat Anda.</p>

        <input type="file" accept="image/*" capture="environment" id="cameraInput" style="display: none;">

        <button onclick="document.getElementById('cameraInput').click()" class="btn btn-primary btn-lg">
            <i class="fas fa-camera"></i> Buka Kamera
        </button>

        <div class="mt-4">
            <img id="preview" src="" alt="Preview Gambar" class="img-fluid rounded"
                style="max-width: 400px; display: none;">
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const cameraInput = document.getElementById('cameraInput');
        const keyPenyimpanan = 'fotoLaporan';

        cameraInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                sessionStorage.setItem(keyPenyimpanan, e.target.result);

                window.location.href = "{{ route('report.preview') }}";
            };

            reader.readAsDataURL(file);
        });
    </script>
@endsection
