<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('front.auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $otp = rand(100000, 999999);

        session([
            'otp' => $otp,
            'reset_email' => $request->email
        ]);

        // Simple mail (can improve later)
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset OTP');
        });

        return redirect()->route('reset.password')
            ->with('success', 'OTP sent to your email');
    }

    public function showResetForm()
    {
        return view('front.auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($request->otp != session('otp')) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        $user = User::where('email', session('reset_email'))->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget(['otp', 'reset_email']);

        return redirect()->route('login')
            ->with('success', 'Password reset successful');
    }
}