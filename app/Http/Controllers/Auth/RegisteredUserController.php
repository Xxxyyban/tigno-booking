<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration page.
     */
    public function create(): View
    {
        return view('auth.customer-register');
    }

    /**
     * Register a new customer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'first_name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'last_name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'email' => [
                    'required',
                    'email',
                    'lowercase',
                    'max:255',
                    'unique:users,email',
                ],
                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[a-z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*?&#]/',
                ],
            ],
            [
                'first_name.regex' => 'First name can only contain letters.',
                'last_name.regex' => 'Last name can only contain letters.',
                'email.unique' => 'This email is already registered.',
                'password.required' => 'Please create a password.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.confirmed' => 'Password confirmation does not match.',
                'password.regex' => 'Password must contain an uppercase letter, lowercase letter, number, and special character.',
            ]
        );

        // Create customer
        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        // Fire registration event
        event(new Registered($user));

        // Login user session safely
        Auth::login($user);

        // Regenerate session tokens to prevent fixation attacks
        $request->session()->regenerate();

        // Production Redirect
        return redirect()->route('booking.details');
    }
}