@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold text-center mb-6">Profile</h2>

            <div class="text-center mb-4">
                <h3 class="text-xl font-medium">{{ $user->name }}</h3>
                <p class="text-gray-500">{{ $user->email }}</p>
            </div>

            <div class="text-center">
                <h4 class="text-lg font-medium mb-2">Your QR Code</h4>
                <img src="{{ asset('storage/' . $user->qr_code) }}" alt="QR Code" class="w-48 h-48 mx-auto">

            </div>
        </div>
    </div>
@endsection
