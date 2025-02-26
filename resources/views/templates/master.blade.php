@extends('templates.master')

@section('title', 'Dashboard Absensi Karyawan')

@push('css')
    {{-- Optional custom styles for this page --}}
@endpush

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-primary text-white p-4" style="width: 250px; height: 100vh;">
            <h2 class="text-center mb-4">Absensi</h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ url('/admin-dashboard') }}" class="nav-link text-white">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" onclick="confirmLogout()" class="nav-link text-white">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-fill p-4">
            <h2>Content Goes Here</h2>
        </div>
    </div>

    @push('js')
        <script>
            function confirmLogout() {
                let confirmAction = confirm("Apakah Anda yakin ingin logout?");
                if (confirmAction) {
                    window.location.href = '{{ route("auth.logout") }}';
                }
            }
        </script>
    @endpush
@endsection
