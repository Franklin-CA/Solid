<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
        ]);

        $fullName = $request->fname . ' ' . $request->lname;

        // Calculate age
        $birthdate = new \DateTime($request->birthdate);
        $currentDate = new \DateTime();
        $age = $currentDate->diff($birthdate)->y;

        User::create([
            'name' => $fullName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'age' => $age,
            'address' => $request->address,
            'usertype' => 'member',
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->usertype === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home')->with('error', 'You do not have admin access.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function logout()
    {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }
        return view('welcome', compact('user'));

    }

    public function paymentform($id)
    {
        // Retrieve a single user by ID
        $user = User::select('id', 'name', 'email', 'paid_date', 'expiry_date', 'is_active')->findOrFail($id);

        // Pass the retrieved user to the view
        return view('admin.paymentform', compact('user'));
    }

    public function updatePayment(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'paid_date' => 'required|date',
            'expiry_date' => 'required|date|after:paid_date',
        ]);
    
        // Find the user
        $user = User::findOrFail($id);
    
        // Ensure the user is authenticated and matches the ID
        if (Auth::id() !== $user->id) {
            return redirect()->route('profile')->with('error', 'Unauthorized action.');
        }
    
        // Set payment status to pending
        $user->payment_status = 'pending';
    
        // Update paid_date and expiry_date
        $user->paid_date = $request->paid_date;
        $user->expiry_date = $request->expiry_date;
    
        // Check if the expiry date is past today and set fields to null if expired
        if ($user->expiry_date && now()->greaterThan($user->expiry_date)) {
            $user->paid_date = null;
            $user->expiry_date = null;
            $user->is_active = false; // Optionally deactivate the user if expired
        }
    
        // Save the updated user
        $user->save();
    
        // Store details in the session for receipt
        session([
            'success' => true,
            'plan' => $request->plan ?? 'Default Plan',
            'amount' => $request->amount ?? 0,
            'paid_date' => $request->paid_date,
            'expiry_date' => $request->expiry_date,
        ]);
    
        // Redirect to the home page to display the receipt
        return redirect()->route('home')->with('success', 'Payment successfully updated!');
    }
}
