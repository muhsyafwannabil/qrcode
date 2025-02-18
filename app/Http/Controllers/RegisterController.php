<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Simpan user baru
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Generate QR Code untuk email pengguna menggunakan API
            $qrCodeData = $this->generateQRCode($user->email);

            // Tentukan path untuk menyimpan QR code
            $qrCodePath = 'qr_codes/' . $user->id . '.png';

            // Simpan QR code ke folder public
            Storage::disk('public')->put($qrCodePath, $qrCodeData);

            // Simpan path QR Code di database
            $user->update(['qr_code' => $qrCodePath]);

            // Simpan pesan sukses ke session
            session()->flash('success', 'User registered successfully and QR code generated.');

            // Redirect ke profil user
            return redirect()->route('user.profile', $user->id);

        } catch (\Exception $e) {
            // Simpan pesan error ke session
            session()->flash('error', 'An error occurred while registering the user. Please try again.');
            return redirect()->back()->withInput();
        }
    }



    public function generateQRCode($data)
    {
        $client = new Client();
        $response = $client->get("https://api.qrserver.com/v1/create-qr-code/", [
            'query' => [
                'data' => $data,
                'size' => '200x200', // Ukuran QR Code
                'format' => 'png', // Format file gambar
            ]
        ]);

        // Mengembalikan gambar QR Code dalam bentuk binary
        return (string) $response->getBody(); // Mengambil body respons yang berisi gambar QR Code
    }

    public function showProfile($id)
    {
        // Ambil data user dari database
        $user = User::findOrFail($id);

        // Tampilkan halaman profil
        return view('user.profile', compact('user'));
    }
}
