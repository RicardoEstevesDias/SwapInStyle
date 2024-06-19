<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register() {
        return view("auth.register");
    }


    public function handleRegister(Request $request): RedirectResponse{
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', "min:8"],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user->id === 1) {
            User::where('id', 1)
                ->update(['is_admin' => 1]);
        }

        Auth::login($user);

        return redirect(route('dashboard'))->with("success", "Inscription OK");
    }


    public  function  login() {
        return view("auth.login");
    }


    public function handleLogin(LoginRequest $request){
        $isLoggedIn = Auth::attempt($request->validated());
        if(!$isLoggedIn) {
            return redirect()->route("login")->with("error", "Identifiants invalides");
        }
            session()->regenerate();
            return  redirect()->route("dashboard")->with("success", "Connexion Ok");
    }


    public function logout(){
        Auth::logout();
        return  redirect()->route("home")->with("success", "Déconnexion Ok");
    }

    public function resetPassword() {
        return view('auth.forgot-password');
    }

    public  function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email']);


        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }


    public  function resetPasswordForm (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    }


    public  function  handleResetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
