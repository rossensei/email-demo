<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        // if (auth()->attempt($credentials)) {
        //     // Check if the authenticated user's email is verified
        //     if (auth()->user()->email_verified_at) {
        //         $request->session()->regenerate();
        //         return redirect('/dashboard');
        //     } else {
        //         // If the email is not verified, log the user out
        //         auth()->logout();
        //         return back()->with('error', 'Your email is not verified. Please check your email for a verification link.');
        //     }
        // }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        $credentials['remember_token'] = Str::random(24);
        $user = User::create($credentials);

        Mail::send('auth.verification-mail', ['user' => $user], function($mail) use ($user) {
            $mail->to($user->email);
            $mail->subject('Account Verification');

        });

        return redirect('/')->with('message', 'Your account has been created. Please check your email for verification.');
    }

    public function verification(User $user, $token)
    {
        if($user->remember_token !== $token) {
            return redirect('/')->with('error', 'Invalid token.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/')->with('message', 'Your account has been verified.');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }
}
