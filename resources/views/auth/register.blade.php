@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md" required value="{{ old('name') }}">

                    @error('name')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md" required value="{{ old('email') }}">

                    @error('email')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md" required>

                    @error('password')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md" required>
                </div>

                <button type="submit"
                    class="w-full p-3 mt-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Register</button>
            </form>
        </div>
    </div>
@endsection
