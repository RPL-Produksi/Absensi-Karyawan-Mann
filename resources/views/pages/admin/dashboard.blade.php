@extends('templates.master')
@section('title', 'Dashboard')

@push('css')
    {{-- CSS Only For This Page --}}
    <link rel="stylesheet" href="{{ asset('vendor/DataTables/datatables.min.css') }}">
@endpush

@section('content')
    <div class="d-flex vh-100" style="min-height: 100vh;">
        @include('templates.sidebar')

        <div class="flex-grow-1 p-4" style="margin-left: 250px; padding-top: 20px;">
            <header class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm border">
                <h1 class="fs-5">Data Karyawan</h1>
                <div class="d-flex align-items-center gap-1">
                    <span id="clock"></span>
                    <button class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
                    <button class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button>
                    <button class="btn btn-warning"><i class="fas fa-file-word"></i> Word</button>
                    <button class="btn btn-danger"><i class="fas fa-envelope"></i> Email</button>
                </div>
            </header>

            <div class="bg-white rounded shadow-sm mt-4 p-3 border">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead class="text-white">
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>No Telp</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Hari, Tanggal</th>
                                <th>Jumlah Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->fullname }}</td>
                                    <td>{{ $item->user->position }}</td>
                                    <td>{{ $item->user->phone_number }}</td>
                                    <td>{{ $item->time_in ?? 'Belum Absen' }}</td>
                                    <td>{{ $item->time_out ?? 'Belum Absen' }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->total_kehadiran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('templates.logout')
@endsection

@push('js')
    {{-- JS Only For This Page --}}
    <script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    <script>
        $('#table-1').DataTable();
    </script>
    <script>
        document.getElementById('clock').innerHTML = new Date().toLocaleTimeString();
        setInterval(() => {
            document.getElementById('clock').innerHTML = new Date().toLocaleTimeString();
        }, 1000);
    </script>
@endpush
