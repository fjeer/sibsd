<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'username' => 'required|string|max:50|unique:users',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        // User creation logic here
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Additional profile information can be saved here
        $user->profile()->create([
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
        // Redirect or return response
        return redirect()->route('login')->with('success', 'Registration successful. Please check your email to verify your account.');
    }

    public function verifyEmail($token)
    {
        // Email verification logic here
        $user = User::where('email_verification_token', $token)->first();
        if ($user) {
            $user->update(['email_verified_at' => now()]);
            return redirect()->route('login')->with('success', 'Email verified successfully.');
        }
        return redirect()->route('login')->with('error', 'Invalid verification token.');
    }

    public function resendVerificationEmail(Request $request)
    {
        // Resend verification email logic here
        $user = User::where('email', $request->email)->first();
        if ($user && !$user->email_verified_at) {
            // Send verification email
            // Mail::to($user->email)->send(new VerifyEmailMail($user));
            return back()->with('success', 'Verification email resent. Please check your inbox.');
    }
        return back()->with('error', 'Email is already verified or does not exist.');
    }
}