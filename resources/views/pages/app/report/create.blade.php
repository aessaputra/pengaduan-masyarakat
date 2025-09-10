@extends('layouts.no-nav')

@section('title', 'Tambah Laporan')

@section('styles')
    <style>
        #map {
            height: 300px;
            border-radius: 0.5rem;
            background-color: #e9ecef;
        }

        #image-preview {
            max-height: 400px;
            width: 100%;
            object-fit: cover;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
        }

        #map-status {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem;
            background-color: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
            border-radius: 0.375rem;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <h3 class="mb-3">Laporkan Masalahmu di Sini!</h3>
    <p class="text-description">Isi formulir di bawah ini dengan lengkap agar laporan Anda dapat segera kami proses.</p>

    <form action="{{ route('report.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="lat" name="latitude">
        <input type="hidden" id="lng" name="longitude">
        <input type="file" id="image" name="image" style="display: none;">

        <div class="mb-3">
            <label class="form-label">Bukti Laporan</label>
            <img alt="Pratinjau Bukti Laporan" id="image-preview" class="img-fluid rounded-2 mb-2">
            <a href="{{ route('report.take') }}" class="d-block mb-3">Ubah Foto</a>
            @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Judul Laporan</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Nomor HP Pelapor</label>
            <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                name="phone_number" value="{{ old('phone_number', Auth::user()->resident->phone_number) }}" required>
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="report_category_id" class="form-label">Kategori Laporan</label>
            <select name="report_category_id" class="form-control @error('report_category_id') is-invalid @enderror">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (old('report_category_id') == $category->id) selected @endif>
                        {{ $category->name }}</option>
                @endforeach
            </select>
            @error('report_category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Ceritakan Laporan Kamu</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                rows="5">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="map" class="form-label">Lokasi Laporan</label>
            <div id="map-status">
                <i class="fas fa-spinner fa-spin"></i>
                <span>Mencari lokasi Anda...</span>
            </div>
            <div id="map" class="mt-2"></div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat Lengkap</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="5">{{ old('address') }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary w-100 mt-2" type="submit">Laporkan</button>
    </form>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const keyPenyimpanan = 'fotoLaporan';
            const imageBase64 = sessionStorage.getItem(keyPenyimpanan);
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');

            if (imageBase64) {
                const blob = base64ToBlob(imageBase64, 'image/jpeg');
                const file = new File([blob], 'laporan.jpg', {
                    type: 'image/jpeg'
                });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                imageInput.files = dataTransfer.files;
                imagePreview.src = URL.createObjectURL(file);
            } else {
                alert('Anda harus mengambil foto terlebih dahulu.');
                window.location.href = "{{ route('report.take') }}";
            }

            function base64ToBlob(base64, mime) {
                const byteString = atob(base64.split(',')[1]);
                const ab = new ArrayBuffer(byteString.length);
                const ia = new Uint8Array(ab);
                for (let i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }
                return new Blob([ab], {
                    type: mime
                });
            }

            const latInput = document.getElementById('lat');
            const lngInput = document.getElementById('lng');
            const mapStatus = document.getElementById('map-status');
            const defaultLocation = [-6.2088, 106.8456];

            const map = L.map('map').setView(defaultLocation, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            let marker = L.marker(defaultLocation, {
                draggable: true
            }).addTo(map);

            function updatePosition(lat, lng) {
                latInput.value = lat;
                lngInput.value = lng;
                marker.setLatLng([lat, lng]);
                map.panTo([lat, lng], 16);
            }

            if (navigator.geolocation) {
                const options = {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                };

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const {
                            latitude,
                            longitude
                        } = position.coords;
                        updatePosition(latitude, longitude);
                        mapStatus.style.display = 'none';
                    },
                    (error) => {
                        let errorMessage = "Gagal mendapatkan lokasi: ";
                        if (error.code === error.TIMEOUT) {
                            errorMessage += "Waktu permintaan habis. Silakan geser pin secara manual.";
                        } else {
                            errorMessage += "Izin ditolak atau layanan lokasi tidak aktif.";
                        }
                        mapStatus.innerHTML = `<span>${errorMessage}</span>`;
                    },
                    options
                );
            } else {
                mapStatus.textContent = "Browser Anda tidak mendukung Geolocation.";
            }

            marker.on('dragend', () => {
                const position = marker.getLatLng();
                updatePosition(position.lat, position.lng);
                if (mapStatus.style.display !== 'none') mapStatus.style.display = 'none';
            });
        });
    </script>
@endsection
