<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
            'username' => 'required|unique:users|min:3|max:20',
            'password' => 'required|min:6|max:50'
        ]);
    
        try {
            User::create([
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
                'is_admin' => false
            ]);
    
            return redirect()->route('register.success');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'An error occurred while creating your account. Please try again.'
            ]);
        }
    }
    
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
    
        return back()->withErrors([
            'auth' => 'Invalid username or password. Please try again.',
        ]);
    }
    
    public function showLoginForm() {
        return view('login');
    }
    

    public function logout(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }    

}
