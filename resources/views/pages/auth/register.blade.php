@extends('templates.master')
@section('title', 'Register')

@push('css')
    {{-- CSS Only For This Page --}}
@endpush

@section('content')
    <div class="d-flex min-vh-100 align-items-center justify-content-center bg-light">
        <div class="bg-white p-4 rounded shadow-lg w-100" style="max-width: 400px;">
            <h1 class="fs-4 fw-bold mb-4 text-center">Register</h1>
            <form action="{{ route('auth.register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="fullname" class="form-label">Fullname</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" name="position" id="position" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="mt-4 text-center">
                <p>Already have an account?
                    <a href="{{ route('index.login') }}" class="text-primary">Login</a>
                </p>
            </div>
            @if($errors->any())
                <div class="mb-3 text-center text-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('js')
    {{-- JS Only For This Page --}}
@endpush
