<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // ゲストログイン処理
    public function guestLogin()
    {
        $guard = 'owners';
        $email = 'test1@test.com';
        $password = 'password123';

        if (Auth::guard($guard)->attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended(RouteServiceProvider::OWNER_HOME);
        }

        return redirect('/owner/login');

    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('owner.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::OWNER_HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('owners')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/owner/login');
    }

    public function changeUser(Request $request)
    {
        Auth::guard('owners')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function changeAdmin(Request $request)
    {
        Auth::guard('owners')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
