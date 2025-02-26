@extends('templates.master')
@section('title', 'Login')

@push('css')
    {{-- CSS Only For This Page --}}
@endpush

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
            <form action="{{ route('auth.login', $isAdmin ? 'admin' : '') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="login"
                        class="block text-sm font-medium text-gray-700">{{ $isAdmin ? 'Username' : 'Email' }}</label>
                    <input type="login" name="login" id="login" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                @if (Session::has('error'))
                    <div class="mb-6 text-center">
                        <span class="text-red-600">{{ Session::get('error') }}</span>
                    </div>
                @endif
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Login
                </button>
            </form>
            <div class="mt-4 text-center">
                <p>Don't have an account?
                    <a href="{{ route('index.register') }}" class="text-blue-600 hover:text-blue-800">Register</a>
                </p>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- JS Only For This Page --}}
@endpush
