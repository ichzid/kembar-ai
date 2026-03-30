<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Cek apakah user sudah terdaftar
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if (!$user) {
                // Buat user baru jika belum ada
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(),
                ]);
            } else {
                // Update informasi user jika sudah ada
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            }
            
            // Login user
            Auth::login($user, true);
            
            return redirect()->route('dashboard');
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login Google gagal: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}