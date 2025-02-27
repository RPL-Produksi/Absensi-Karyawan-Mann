<div class="bg-primary text-white p-4" style="width: 250px; height: 100vh; position: fixed;">
    @can('admin')
        @php
            $unreadNotifications = App\Models\Notification::where('user_id', auth()->id())
                ->where('is_read', false)
                ->count();
        @endphp

        <h2 class="text-center mb-4">Admin</h2>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('notifications.index') }}" class="nav-link text-white">
                    <i class="fas fa-bell"></i>
                    @if ($unreadNotifications > 0)
                        <span class="badge text-bg-danger">{{ $unreadNotifications }}</span>
                    @endif
                    Notifikasi
                </a>
            </li>
            <li class="nav-item">
                <button data-bs-toggle="modal" data-bs-target="#logoutModal" class="nav-link text-white">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </li>
        </ul>
    @endcan

    @can('user')
        <h2 class="text-center mb-4">User</h2>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('user.dashboard') }}" class="nav-link text-white">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="fas fa-user"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <button data-bs-toggle="modal" data-bs-target="#logoutModal" class="nav-link text-white">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </li>
        </ul>
    @endcan
</div>
