<div class="floating-button-container d-flex" onclick="window.location.href = 'take-report'">
    <button class="floating-button">
        <i class="fa-solid fa-camera"></i>
    </button>
</div>
<nav class="nav-mobile d-flex">
    <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
        <i class="fas fa-house"></i>
        Beranda
    </a>
    <a href="{{ route('report.myreport', ['status' => 'delivered']) }}" class="">
        <i class="fas fa-solid fa-clipboard-list"></i>
        Laporanmu
    </a>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <a href="{{ route('notifications.index') }}"
        class="{{ request()->routeIs('notifications.index') ? 'active' : '' }}">
        <div class="position-relative">
            <i class="fas fa-bell"></i>
            @if (isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    style="font-size: 0.65em;">
                    {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                    <span class="visually-hidden">unread messages</span>
                </span>
            @endif
        </div>
        Notifikasi
    </a>
    @auth
        <a href="{{ route('profile') }}" class="">
            <i class="fas fa-user"></i>
            Profil
        </a>
    @else
        <a href="{{ route('register') }}" class="">
            <i class="fas fa-right-to-bracket"></i>
            Daftar
        </a>
    @endauth
</nav>
