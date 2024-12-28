<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $users = User::where('usertype', 'member')->get();

        return view('admin.dashboard', compact('users'));
    }

    public function deleteUser($id)
    {
        if (Auth::user()->usertype === 'admin') {
            $user = User::where('id', $id)->where('usertype', 'member')->first();

            if ($user) {
                $user->delete();
                return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
            }

            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

    public function handleSubscription(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->usertype !== 'admin' || $user->usertype !== 'member') {
            return redirect()->route('admin.dashboard')->with('error', 'Unauthorized or invalid action.');
        }

        if ($request->action === 'approve') {
            $user->update([
                'payment_status' => 'approved',
                'is_active' => true,
                'paid_date' => now(),
                'expiry_date' => now()->addMonth(),
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Subscription approved.');
        } elseif ($request->action === 'reject') {
            $user->update([
                'payment_status' => 'rejected',
                'is_active' => false,
                'paid_date' => null,
                'expiry_date' => null,
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Subscription rejected.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'Invalid action.');
    }

    public function showAddUserForm()
    {
        return view('admin.storeUser');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
            'payment_status' => 'required|in:pending,approved,rejected',
            'is_active' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'age' => now()->diffInYears($request->birthdate),
            'address' => $request->address,
            'usertype' => 'member',
            'paid_date' => $request->paid_date,
            'expiry_date' => $request->expiry_date,
            'payment_status' => $request->payment_status,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Member added successfully.');
    }

    public function paymentHistory($userId)
    {
        $user = User::with('paymentHistories')->findOrFail($userId);
        
        $paymentHistory = $user->paymentHistories;

        return view('admin.paymentHistory', compact('user', 'paymentHistory'));
    }
}
