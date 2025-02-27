@extends('templates.master')

@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/DataTables/datatables.min.css') }}">
    <style>
        .chart-container {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            max-height: 500px;
            margin-left: 10px;
        }
    </style>
@endpush

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="d-flex vh-100" style="min-height: 100vh;">
        <!-- Sidebar -->
        @include('pages.users.(components).sidebar')

        <!-- Main Content -->
        <div class="flex-grow-1 p-4" style="margin-left: 250px; padding-top: 20px;">
            <header class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm border mb-4">
                <h1 class="fs-5">Dashboard</h1>
                <div class="d-flex align-items-center gap-1">
                    <span id="clock"></span>
                </div>
            </header>

            <!-- Attendance Table -->
            <div class="bg-white rounded shadow-sm mt-4 p-3 border">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead class="text-white bg-primary">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $key => $attendance)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $attendance->user->fullname }}</td>
                                    <td>{{ $attendance->user->position }}</td>
                                    <td>{{ $attendance->day }}</td>
                                    <td>{{ $attendance->date }}</td>

                                    @php
                                        $currentDate = now()->format('Y-m-d');
                                        $attendanceDate = \Carbon\Carbon::parse($attendance->date)->format('Y-m-d');
                                    @endphp

                                    <!-- Check-in -->
                                    <td>
                                        @if ($attendance->time_in && $attendanceDate === $currentDate)
                                            {{ \Carbon\Carbon::parse($attendance->time_in)->format('H:i:s') }}
                                        @elseif ($attendanceDate < $currentDate)
                                            -
                                        @else
                                            <form action="{{ route('check.in') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                                <button type="submit" class="btn btn-secondary">Check-in</button>
                                            </form>
                                        @endif
                                    </td>

                                    <!-- Check-out -->
                                    <td>
                                        @if ($attendance->time_out && $attendanceDate === $currentDate)
                                            {{ \Carbon\Carbon::parse($attendance->time_out)->format('H:i:s') }}
                                        @elseif ($attendanceDate < $currentDate)
                                            -
                                        @else
                                            <form action="{{ route('check.out') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                                <button type="submit" class="btn btn-secondary">Check-out</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <h3 class="fs-5">Data Kehadiran</h3>
                        <canvas id="chartAttendance" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('templates.logout')
    @include('templates.profile')
@endsection

@push('js')
    <script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>

    <script>
        $('#table-1').DataTable();
    </script>
    <script>
        const ctx = document.getElementById('chartAttendance').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Hadir', 'Tidak Hadir'],
                datasets: [{
                    data: {!! json_encode($dataAttendances) !!},
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            }
        });

        function updateClock() {
            const now = new Date();
            document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID');
        }

        setInterval(updateClock, 1000); // Update the clock every second
        updateClock(); // Initial call to display the current time, date, and day
    </script>
@endpush
