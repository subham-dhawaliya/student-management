<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = User::query();

        if (request('q')) {
            $q = request('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $users = $query->latest()->paginate(10);

        return view('dashboard', compact('user', 'users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'nullable|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin') && $request->is_admin == '1',
        ]);

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }

    public function destroyUser(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->email === 'skgdhawaliya@gmail.com') {
            return redirect()->route('dashboard')->with('error', 'Cannot delete admin user.');
        }

        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    }
}
