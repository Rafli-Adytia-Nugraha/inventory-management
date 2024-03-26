<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {
        return view('page.auth.login');
    }

    public function authenticate(AuthenticateRequest $request)
    {
        if (Auth::attempt($request->only('username', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username atau Password yang anda masukkan salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('logout.index');
    }

    public function logoutIndex()
    {
        return view('page.auth.logout');
    }

    public function forgetIndex()
    {
        return view('page.auth.reset-password');
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
    }

    public function resetIndex($token)
    {
        return view('page.auth.change-password', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')
        : back()->withErrors(['email' => [__($status)]]);
    }
}
