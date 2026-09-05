<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        $users = User::orderBy('firstname')->paginate(10);

        return view('admin.usermanagment', compact('users'));
    }

    public function show($id)
    {

        $user = User::find($id);

        if (! $user) {
            return redirect()->route('dashboard.user')->with('error', 'User not found.');
        }

        return view('admin.usermanagment', compact('user'));
    }

    public function addUser()
    {
        return view('admin.adduser');
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

        $avatarPath = null;

        if ($request->hasFile('user_avatar')) {
            $avatarPath = $request->file('user_avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => bcrypt($validatedData['password']),
            'user_avatar' => $avatarPath,
        ]);

        return redirect()->route('dashboard.user')->with('success', 'User added successfully.');
    }

    public function editUser($id)
    {
        $user = User::find($id);

        if (! $user) {
            return redirect()->route('dashboard.user')->with('error', 'User not found.');
        }

        return view('admin.edituser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'role' => 'required|in:user,admin,author',
            'password' => 'nullable|string|min:8|confirmed',
            'user_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $avatarPath = $user->user_avatar;

        if ($request->hasFile('user_avatar')) {
            $avatarPath = $request->file('user_avatar')->store('avatars', 'public');
        }

        $user->update([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'role' => $validatedData['role'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
            'user_avatar' => $avatarPath,
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

        $users = User::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('firstname', 'like', '%'.$searchTerm.'%')
                    ->orWhere('lastname', 'like', '%'.$searchTerm.'%')
                    ->orWhere('username', 'like', '%'.$searchTerm.'%')
                    ->orWhere('email', 'like', '%'.$searchTerm.'%');
            })
            ->orderBy('firstname')
            ->paginate(10);

        return view('admin.usermanagment', compact('users'));
    }
}
