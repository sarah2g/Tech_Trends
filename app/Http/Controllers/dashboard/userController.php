<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        $users = User::all()->paginate(10);

        return view('dashboard.user', compact('users'));
    }

    public function show($id)
    {

        $user = User::find($id);

        if (! $user) {
            return redirect()->route('dashboard.user')->with('error', 'User not found.');
        }

        return view('dashboard.user', compact('user'));
    }

    public function addUser()
    {
        return view('dashboard.adduser');
    }

    public function add(Request $request)
    {

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:user,admin,author',

            'password' => 'required|string|min:8|confirmed',
            'user_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => bcrypt($validatedData['password']),
            'user_avatar' => $validatedData['user_avatar'] ?? null,
        ]);

        return redirect()->route('dashboard.adduser')->with('success', 'User added successfully.');
    }

    public function editUser($id)
    {
        $user = User::find($id);

        if (! $user) {
            return redirect()->route('dashboard.user')->with('error', 'User not found.');
        }

        return view('dashboard.edituser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',

            'role' => 'required|in:user,admin,author',
            'password' => 'nullable|string|min:8|confirmed',

        ]);
        $user->update([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],

            'role' => $validatedData['role'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,

        ]);

        return redirect()->route('dashboard.user')->with('success', 'User updated successfully.');

    }

    public function delete($id)
    {
        $user = User::find($id);

        if (! $user) {
            return redirect()->route('dashboard.user')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('dashboard.user')->with('success', 'User deleted successfully.');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::where('firstname', 'like', '%'.$searchTerm.'%')
            ->orWhere('lastname', 'like', '%'.$searchTerm.'%')
            ->orWhere('username', 'like', '%'.$searchTerm.'%')
            ->orWhere('email', 'like', '%'.$searchTerm.'%')
            ->get();

        return view('dashboard.user', compact('users'));
    }
}
