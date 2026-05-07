<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

// Requests
use App\Http\Requests\Auth\LoginAttemptRequest;

class AuthController extends Controller
{
    public function login_view(): View
    {
        return view('pages.auth.login');
    }

    public function login_attempt(LoginAttemptRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return back()->withErrors('Email atau Kata Sandi salah.')->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard.index')->with('success', 'Berhail masuk.');
    }

    public function logout_attempt(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.view')->with('success', 'Berhasil keluar.');
    }
}
