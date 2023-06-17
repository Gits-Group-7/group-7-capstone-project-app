<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthCustomerController extends Controller
{
    public function register()
    {
        return view('pages.customer.auth-customer.register-customer');
    }

    public function login()
    {
        return view('pages.customer.auth-customer.login-customer');
    }

    public function doRegister(Request $request)
    {
        // fungsi validasi sebelum melakukan register
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:' . AuthUser::class],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required', Rules\Password::defaults()],
        ]);

        // insert data user dengan menggunakan validasi
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // langsung memberikan akses login setelah melakukan register
        Auth::login($user);

        return redirect()->route('customer.profile', $user->id);
    }

    public function doLogin(Request $request)
    {
        // fungsi validasi sebelum melakukan login
        $credentials = $request->validate([
            'email' => ['required', 'string', 'max:100', 'email'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // mengecek kredential ketika request login berlangsung
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->check() && auth()->user()->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else if (auth()->check() && auth()->user()->role == 'customer') {
                $id = auth()->user()->id;
                return redirect()->route('customer.profile', $id);
            }
        }

        // menampilkan pesan error jika kredential yang dimasukkan salah
        return back()->withErrors([
            'email' => 'Email and password invalid.',
        ])->onlyInput('email');
    }
}
