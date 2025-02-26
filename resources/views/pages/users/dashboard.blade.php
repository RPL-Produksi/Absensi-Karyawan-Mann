@extends('templates.master')

@section('title', 'Dashboard Absensi Karyawan')

@push('css')
    {{-- Custom styles for this page --}}
@endpush

@section('content')
    <div class="flex bg-gray-100">
        <div class="sidebar w-64 bg-primary text-white h-screen fixed p-6 transition-all duration-300 ease-in-out hover:w-48">
            <h2 class="text-center text-xl font-semibold mb-6">Absensi</h2>
            <ul class="space-y-4">
                <li><a href="{{ url('/admin-dashboard') }}" class="flex items-center p-3 text-white hover:bg-white hover:bg-opacity-20 rounded-md"><i class="fas fa-home mr-3"></i> Dashboard</a></li>
                <li><a href="#" class="flex items-center p-3 text-white hover:bg-white hover:bg-opacity-20 rounded-md"><i class="fas fa-user mr-3"></i> Profile</a></li>
                <li><a href="#" onclick="confirmLogout()" class="flex items-center p-3 text-white hover:bg-white hover:bg-opacity-20 rounded-md"><i class="fas fa-sign-out-alt mr-3"></i> Logout</a></li>
            </ul>
        </div>

        <div class="main-content ml-64 w-full p-6">
            <header class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-semibold">Selamat datang, Ayu Nur'aeni</h2>
                <div class="clock font-bold text-xl" id="clock"></div>
            </header>

            <div class="table-container bg-white p-6 rounded-lg shadow-md mb-8">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-secondary text-white">No</th>
                            <th class="px-4 py-2 bg-secondary text-white">Nama</th>
                            <th class="px-4 py-2 bg-secondary text-white">Jabatan</th>
                            <th class="px-4 py-2 bg-secondary text-white">Hari</th>
                            <th class="px-4 py-2 bg-secondary text-white">Tanggal</th>
                            <th class="px-4 py-2 bg-secondary text-white">Check-in</th>
                            <th class="px-4 py-2 bg-secondary text-white">Check-out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">Ayu Nur'aeni</td>
                            <td class="px-4 py-2">Staff Engineering</td>
                            <td class="px-4 py-2" id="day"></td>
                            <td class="px-4 py-2" id="date"></td>
                            <td class="px-4 py-2" id="checkin-time">
                                <button onclick="updateTime('checkin')" class="bg-secondary text-white py-2 px-4 rounded-md hover:bg-blue-600">Check-in</button>
                            </td>
                            <td class="px-4 py-2" id="checkout-time">
                                <button onclick="updateTime('checkout')" class="bg-secondary text-white py-2 px-4 rounded-md hover:bg-blue-600">Check-out</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="chart-container bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-lg font-semibold mb-4">Rangkuman Bulanan</h3>
                <canvas id="attendanceChart"></canvas>
            </div>
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

            function updateClock() {
                const now = new Date();
                document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID');
                document.getElementById('date').textContent = now.toLocaleDateString('id-ID');
                document.getElementById('day').textContent = now.toLocaleDateString('id-ID', { weekday: 'long' });
            }

            setInterval(updateClock, 1000);
            updateClock();

            function updateTime(type) {
                const time = new Date().toLocaleTimeString('id-ID');
                document.getElementById(`${type}-time`).innerHTML = time;
            }

            const ctx = document.getElementById('attendanceChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Hadir', 'Tidak Hadir', 'Sakit', 'Tanpa Keterangan'],
                    datasets: [{
                        data: [20, 5, 3, 2],
                        backgroundColor: ['#28a745', '#dc3545', '#ffc107', '#6c757d']
                    }]
                }
            });
        </script>
    @endpush
@endsection
