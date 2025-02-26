@extends('templates.master')
@section('title', 'Login')

@push('css')
    {{-- CSS Only For This Page --}}
@endpush

@section('content')
    <div class="d-flex min-vh-100 align-items-center justify-content-center bg-light">
        <div class="bg-white p-4 rounded shadow-lg w-100" style="max-width: 400px;">
            <h1 class="fs-4 fw-bold mb-4 text-center">Login</h1>
            <form action="{{ route('auth.login', $isAdmin ? 'admin' : '') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="login" class="form-label">{{ $isAdmin ? 'Username' : 'Email' }}</label>
                    <input type="text" name="login" id="login" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                @if (Session::has('error'))
                    <div class="mb-3 text-center text-danger">
                        <span>{{ Session::get('error') }}</span>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="mt-3 text-center">
                <p>Don't have an account? <a href="" class="text-primary">Register</a></p>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- JS Only For This Page --}}
@endpush
