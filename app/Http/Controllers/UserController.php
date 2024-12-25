<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{

    //====================================================================================================== 
    // Register a new user
    //======================================================================================================

    public function register(Request $request)
    {
        // Rate limit registration attempts to prevent abuse
        if (RateLimiter::tooManyAttempts('register_' . $request->ip(), 5)) {
            return response()->json(['message' => 'Too many registration attempts. Please try again later.'], 429);
        }

        // Validate the incoming request
        $registrationInputs = $request->validate([
            'full_name' => 'required|string|min:4|max:30',
            'user_email' => 'required|email:rfc,dns|unique:users,email',
            'user_password' => 'required|string|min:8|confirmed',
        ], [
            'user_email.unique' => 'This email address is already registered.',
            'user_email.email' => 'Please provide a valid email address.',
            'user_password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Sanitize user inputs
        $registrationInputs['full_name'] = strip_tags($registrationInputs['full_name']);
        $registrationInputs['user_email'] = filter_var($registrationInputs['user_email'], FILTER_SANITIZE_EMAIL);

        // Hash the password using Hash facade (more secure and flexible than bcrypt directly)
        $hashedPassword = Hash::make($registrationInputs['user_password']);

        // Create the user
        $user = User::create([
            'name' => $registrationInputs['full_name'],
            'email' => $registrationInputs['user_email'],
            'password' => $hashedPassword,  // Store hashed password
        ]);

        // Log the registration attempt
        Log::info('New user registered: ' . $user->email);

        // Automatically send an email verification link to the user
        event(new Registered($user));

        // Log in the user immediately after registration
        Auth::login($user);

        // Increment rate limiter for this IP
        RateLimiter::hit('register_' . $request->ip());

        // Redirect to the homepage with a success message
        return redirect()->route('home')->with('success', 'Account created successfully! Please check your email to verify your account.');
    }



    //======================================================================================================
    // Login user
    //======================================================================================================

    public function login(Request $request)
    {
        // Validate the incoming request
        $loginInputs = $request->validate([
            'user_email' => 'required|email:rfc,dns',
            'user_password' => 'required|string',
        ], [
            'user_email.required' => 'Please enter your email address.',
            'user_password.required' => 'Please enter your password.',
        ]);

        // Check if the user exists with the given email
        $user = User::where('email', $loginInputs['user_email'])->first();

        if (!$user) {
            return back()->withErrors([
                'user_email' => 'Incorrect email address.',
            ])->withInput($request->only('user_email'));
        }

        // Log failed login attempts
        Log::warning('Failed login attempt', ['email' => $loginInputs['user_email']]);

        // Attempt to authenticate the user
        if (Auth::attempt([
            'email' => $loginInputs['user_email'],
            'password' => $loginInputs['user_password']
        ], $request->remember)) {
            // On success, redirect to the intended page
            return redirect()->intended('/')->with('success', 'You are logged in successfully!');
        }

        // If login fails, return an error for incorrect password
        return back()->withErrors([
            'user_password' => 'Incorrect password.',
        ])->withInput($request->only('user_email')); 
    }




    //======================================================================================================
    // Logout the currently logged-in user
    //======================================================================================================
    public function logout()
    {
        Auth::logout(); // Log the user out of the session

        // Redirect the user to the home page with a success message
        return redirect('/login')->with('success', 'You have successfully logged out.');
    }
}
