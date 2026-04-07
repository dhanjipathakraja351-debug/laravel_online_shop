<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // LIST USERS
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.list', compact('users'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('admin.users.create');
    }

    // STORE USER
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
             'phone' => $request->phone,
             'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->status = $request->status;

    $user->save();

    return redirect()->route('admin.users.index')
        ->with('success', 'User updated successfully');
}

public function delete($id)
{
    User::findOrFail($id)->delete();

    return redirect()->route('admin.users.index')
        ->with('success', 'User deleted successfully');
  }

}