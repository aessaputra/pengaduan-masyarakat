@extends('layouts.app')

@section('title', 'Bantuan dan Dukungan')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Pusat Bantuan</h4>
        </div>
        <div class="card-body">
            <h5 class="mb-3">Pertanyaan yang Sering Diajukan (FAQ)</h5>

            <div class="accordion" id="faqAccordion">
                {{-- Pertanyaan 1 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Bagaimana cara mengubah profil saya?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda dapat mengubah nama dan foto profil Anda melalui menu "Pengaturan Akun" di halaman profil.
                            Jika Anda mendaftar secara manual, Anda juga dapat mengubah kata sandi Anda melalui menu "Kata
                            sandi".
                        </div>
                    </div>
                </div>

                {{-- Pertanyaan 2 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Bagaimana cara membuat laporan?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Untuk membuat laporan, silakan pergi ke halaman utama dan klik tombol "Buat Laporan". Ikuti
                            langkah-langkah yang diberikan, termasuk mengambil foto, mengisi deskripsi, dan menandai lokasi
                            Anda.
                        </div>
                    </div>
                </div>

                {{-- Pertanyaan 3 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Saya lupa kata sandi, apa yang harus saya lakukan?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Jika Anda lupa kata sandi, silakan gunakan fitur "Lupa Kata Sandi" yang tersedia di halaman
                            login. Fitur ini hanya tersedia untuk akun yang didaftarkan secara manual, bukan melalui Google.
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Hubungi Kami</h5>
            <p>Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan teknis, jangan ragu untuk menghubungi
                kami melalui:</p>
            <ul>
                <li><strong>Email:</strong> support@suararakyat.com</li>
                <li><strong>Telepon:</strong> (021) 123-4567</li>
                <li><strong>Jam Operasional:</strong> Senin - Jumat, 09:00 - 17:00 WIB</li>
            </ul>
        </div>
    </div>
@endsection
