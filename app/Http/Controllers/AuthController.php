<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Login"
        ];
        return view('pages.auth.login', $data);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);



        if (Auth::attempt($credentials)) {
            $dataUser = User::where('email', $request->email)->first();
            if ($dataUser->status_id == 2) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Akun belum diaktifkan Admin.');
            }
            $request->session()->regenerate();

            session(
                [
                    "id" => $dataUser->id,
                    "status_id" => $dataUser->status_id,
                    "role_id" => $dataUser->role_id,
                    "name" => $dataUser->name,
                    "email" => $dataUser->email,
                    "timelog" => Carbon::now(),
                ]
            );

            return redirect()->intended('/');
        }

        return redirect('/login')->with('error', 'Email atau Password Salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register()
    {
        $data = [
            "title" => "Register"
        ];
        return view('pages.auth.register', $data);
    }

    public function registration(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|max:255",
            "email" => "required|email:dns|unique:users",
            "password" => "required|min:5|max:255",
        ]);

        if ($request->password === $request->password2) {
            $validatedData["status_id"] = 2;
            $validatedData["role_id"] = 2;
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);
            return redirect('/login')->with('success', 'Pendaftaran Berhasil!');
        } else {
            return redirect('/register')->with('error', 'Password tidak sama!');
        }
    }
}
