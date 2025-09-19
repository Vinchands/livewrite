<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('login');
    }
    
    public function registerView()
    {
        return view('register');
    }
    
    public function register(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ], [
          'email.unique' => 'Please try different email.'
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);

        Auth::login($user);

        return to_route('todos');
    }
    
    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $remember = $request->filled('remember');
        
        if (Auth::attempt($validated, $remember)) {
            $request->session()->regenerate();
            
            return to_route('todos');
        }
        
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }
    
    public function logout(Request $request): RedirectResponse
    {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return to_route('login');
    }
}
