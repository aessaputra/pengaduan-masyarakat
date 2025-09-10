@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Notifikasi</h4>
        </div>
        <div class="list-group list-group-flush">
            @forelse ($notifications as $notification)
                @php
                    $statusText = '';
                    switch ($notification->data['status']) {
                        case 'in-process':
                            $statusText = 'sedang diproses';
                            break;
                        case 'completed':
                            $statusText = 'telah selesai';
                            break;
                        case 'rejected':
                            $statusText = 'ditolak';
                            break;
                        default:
                            $statusText = 'diperbarui';
                            break;
                    }
                @endphp
                <a href="{{ route('report.show', $notification->data['report_code']) }}"
                    class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">
                            Laporan Anda <strong>"{{ Str::limit($notification->data['report_title'], 30) }}"</strong>
                            {{ $statusText }}.
                        </p>
                    </div>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </a>
            @empty
                <div class="d-flex flex-column justify-content-center align-items-center text-center" style="height: 75vh">
                    <div id="lottie-animation" style="width: 200px; height: 200px;"></div>
                    <h5 class="mt-3">Belum ada notifikasi</h5>
                    <p class="text-muted">Semua pembaruan laporan Anda akan muncul di sini.</p>
                </div>
            @endforelse
        </div>
        @if ($notifications->hasPages())
            <div class="card-footer">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    @if ($notifications->isEmpty())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
        <script>
            var animation = bodymovin.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '{{ asset('assets/app/lottie/not-found.json') }}'
            });
        </script>
    @endif
@endsection
