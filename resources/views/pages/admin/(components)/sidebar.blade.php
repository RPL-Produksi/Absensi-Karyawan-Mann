<div class="bg-primary text-white p-4" style="width: 250px;">
    <h2 class="text-center mb-4">Admin</h2>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="" class="nav-link text-white">
                <i class="fas fa-bell"></i> Notifikasi
            </a>
        </li>
        <li class="nav-item">
            <button data-bs-toggle="modal" data-bs-target="#logoutModal" class="nav-link text-white">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </li>
    </ul>
</div>
