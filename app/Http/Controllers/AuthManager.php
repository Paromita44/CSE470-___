<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    /**
     * Show the login page.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        // If the user is already logged in, redirect to the dashboard.
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Handle the login form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user.
        if (Auth::attempt($credentials)) {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the user is an admin
            if ($user->is_admin) {
                // Redirect to the admin dashboard
                return redirect()->route('admin.dashboard');
            }

            // Redirect to the user dashboard
            return redirect()->route('user.dashboard');
        }

        return redirect(route('login'))->with('error', 'Invalid login credentials.');
    }

    /**
     * Show the registration page.
     *
     * @return \Illuminate\View\View
     */
    public function registration()
    {
        // If the user is already logged in, redirect to the dashboard.
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('registration');
    }

    /**
     * Handle the registration form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data = $request->only('name', 'email', 'password');
        $data['password'] = Hash::make($data['password']); // Encrypt the password

        $user = User::create($data);

        if (!$user) {
            return redirect(route('registration'))->with('error', 'Registration failed, please try again.');
        }

        return redirect(route('login'))->with('success', 'Registration successful. Please log in.');
    }

    /**
     * Handle user logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect(route('home'));  // Redirect to home page after logout
    }
}