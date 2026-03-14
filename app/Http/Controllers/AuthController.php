<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => __('The provided credentials do not match our records.'),
        ])->onlyInput('email');
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle registration attempt.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'manager', // Default role for new signups
        ]);

        Auth::login($user);

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Show the OTP request form (password reset step 1).
     */
    public function showOtpRequestForm()
    {
        return view('auth.otp-request');
    }

    /**
     * Send OTP to user (simulated via Log).
     */
    public function requestOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        // Generate a 6-digit OTP
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP and expiry in session (keyed by email)
        session([
            'otp_code'    => $otp,
            'otp_email'   => $request->email,
            'otp_expires' => now()->addMinutes(10),
        ]);

        // Simulate sending OTP — write to log instead of email/SMS
        Log::info("CoreInventory OTP for [{$request->email}]: {$otp}");

        return redirect()->route('otp.verify.form')
            ->with('status', 'An OTP has been sent. Check the application log.');
    }

    /**
     * Show the OTP verification form (password reset step 2).
     */
    public function showOtpVerifyForm()
    {
        return view('auth.otp-verify');
    }

    /**
     * Verify OTP and reset password.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email'        => ['required', 'email', 'exists:users,email'],
            'otp'          => ['required', 'string', 'size:6'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Validate OTP against session
        $sessionEmail   = session('otp_email');
        $sessionOtp     = session('otp_code');
        $sessionExpires = session('otp_expires');

        if (
            $request->email !== $sessionEmail
            || $request->otp !== $sessionOtp
            || now()->greaterThan($sessionExpires)
        ) {
            return back()->withErrors(['otp' => 'The OTP is invalid or has expired.']);
        }

        // Reset the password
        $user = User::where('email', $request->email)->firstOrFail();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Clear OTP session data
        session()->forget(['otp_code', 'otp_email', 'otp_expires']);

        return redirect()->route('login')
            ->with('status', 'Password has been reset successfully. Please log in.');
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
