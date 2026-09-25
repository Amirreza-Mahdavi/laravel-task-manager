<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthController extends Controller {
    public function showLogin(): View {
        
        return view('auth.login');
    }

    public function showRegister(): View {
        
        return view('auth.register');
    }

    public function login(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
            ->withErrors([
                'email' => 'The provided credentials are incorrect.',
            ])
            ->onlyInput('email');
        }

        $request->session()->regenerate();
        $user = $request->user();

        if ($user->role?->name === 'admin') 
            return redirect()->route('admin.tasks.index');

        return redirect()->route('tasks.index');
    }

    public function register(Request $request): RedirectResponse {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/tasks');
    }


    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}