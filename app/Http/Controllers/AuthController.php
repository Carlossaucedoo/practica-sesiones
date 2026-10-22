<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Comprueba el email y la contraseña, crea un token y lo guarda en la sesión junto con el nombre.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $user = User::where('email', $credentials['email'])->first();

            if (! $user || ! Hash::check($credentials['password'], $user->password)) {
                return back()
                    ->withErrors(['email' => 'El email o la contraseña no son correctos.'])
                    ->onlyInput('email');
            }

            $token = Token::create([
                'user_id' => $user->id,
                'token' => Str::random(60),
            ]);

            $request->session()->regenerate();
            session(['token' => $token->token, 'name' => $user->name]);

            return redirect()->route('home')->with('status', 'Sesión iniciada correctamente.');
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors(['email' => 'Error al iniciar sesión.'])->onlyInput('email');
        }
    }

    /**
     * Borra el token y la sesión y redirige al login.
     */
    public function logout(Request $request): RedirectResponse
    {
        try {
            Token::where('token', session('token'))->delete();
        } catch (Throwable $e) {
            report($e);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Muestra el formulario para crear una cuenta.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Crea un usuario nuevo con la contraseña hasheada.
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed',
        ]);

        try {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return redirect()->route('login')->with('status', 'Cuenta creada. Ya puedes iniciar sesión.');
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors(['email' => 'Error al crear la cuenta.'])->withInput($request->except('password', 'password_confirmation'));
        }
    }
}
