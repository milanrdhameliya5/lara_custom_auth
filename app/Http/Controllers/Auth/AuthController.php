<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginRquest(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Logged In');
        }

        return redirect("login")->withSuccess('Wrong Email OR password');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function registerRquest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function dashboard(Request $request)
    {
        return view('dashboard');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
}
