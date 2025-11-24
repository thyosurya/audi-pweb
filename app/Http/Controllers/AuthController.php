<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember_me'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Check if user is admin or owner
            $isAdmin = DB::table('admin')->where('id_user', $user->id)->exists();
            $isOwner = DB::table('owner')->where('id_user', $user->id)->exists();

            // Store role in session
            if ($isOwner) {
                $request->session()->put('role', 'owner');
                return redirect()->route('owner.dashboard');
            } else if ($isAdmin) {
                $request->session()->put('role', 'admin');
            }

            return redirect()->route('dashboard');
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

        return redirect()->route('login');
    }
}
