<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Gunakan kredensial 'email' dan 'password' untuk proses login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['social_login' => 'Could not authenticate with Google. Please try again.']);
        }

        // Cek apakah user sudah ada di database berdasarkan google_id atau email
        $user = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

        if ($user) {
            // Jika user sudah ada, update google_id jika belum ada dan login
            if (empty($user->google_id)) {
                $user->google_id = $googleUser->id;
                $user->save();
            }
            Auth::login($user, true);
        } else {
            // Jika user belum ada, buat user baru
            $user = User::create([
                'nama' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt(Str::random(24)), // Password acak, user bisa ganti nanti
                'no_hp' => null, // Atau minta user untuk mengisi ini nanti
            ]);
            Auth::login($user, true);
        }

        return redirect()->intended('/');
    }
}