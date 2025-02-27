@extends('templates.master')
@section('title', 'Notification')

@push('css')
    {{-- CSS Only For This Page --}}
    <link rel="stylesheet" href="{{ asset('vendor/DataTables/datatables.min.css') }}">
@endpush

@section('content')
    <div class="d-flex vh-100">
        @include('templates.sidebar')

        <div class="flex-grow-1 p-4" style="margin-left: 250px; padding-top: 20px;">
            <header class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm border">
                <h1 class="fs-5">Notifikasi</h1>
                <div class="d-flex align-items-center gap-1">
                    <form action="{{ route('notifications.readAll') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i> Baca Semua</button>
                    </form>
                </div>
            </header>

            <div class="bg-white rounded shadow-sm mt-4 p-3 border">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead class="text-white">
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->message }}</td>
                                    <td>
                                        @if (!$item->is_read)
                                            <form action="{{ route('notifications.read', $item->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-primary"><i
                                                        class="fa-regular fa-eye"></i></button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-secondary" disabled><i
                                                    class="fa-regular fa-eye"></i></button>
                                        @endif
                                    </td>
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
@endpush
