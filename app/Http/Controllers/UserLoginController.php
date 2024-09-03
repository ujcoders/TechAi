<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'empcode' => 'required',
            'password' => 'required',
        ]);

        // Retrieve credentials from the request
        $empcode = $request->input('empcode');
        $password = $request->input('password');

        // Retrieve the user by empcode
        $user = User::where('empcode', $empcode)->first();

        // Check if user exists and password matches
        if ($user && $user->password === $password) {
            // Log the user in
            Auth::login($user);
            // Redirect to the dashboard if successful
            return redirect()->route('dashboard');
        }

        // Redirect back with an error message if authentication fails
        return back()->withErrors([
            'empcode' => 'Invalid Employee Code or Password.',
        ]);
    }

    public function dashboard()
    {
         // Fetch counts from the user and doctor tables
        $userCount = \App\Models\User::count();
        $doctorCount = \App\Models\Doctor::count();

        // Pass counts to the view
        return view('dashboard', compact('userCount', 'doctorCount'));
    }

    public function addDoctor()
    {
        return view('add-doctor'); // Ensure you have this view file
    }

    public function doctorList()
    {
        // Logic to get the doctor list
        $doctors = [
            ['id' => 1, 'name' => 'Dr. John Doe', 'city' => 'New York'],
            ['id' => 2, 'name' => 'Dr. Jane Smith', 'city' => 'Los Angeles'],
        ];

        // Return the view with the list of doctors
        return view('doctor-list', ['doctors' => $doctors]);
    }

    // Show user profile
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user')); // Pass the user data to the profile view
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
