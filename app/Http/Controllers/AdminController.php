<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $users = DB::select("SELECT * FROM user_info");
        return view('admin.users.index', ['users' => $users]);
    }

    // Show the form to create a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user_info,name',
            'email' => 'required|email|max:255|unique:user_info,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        DB::insert("INSERT INTO user_info (name, email, password, roles, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())", [
            $request->name,
            $request->email,
            Hash::make($request->password),
            $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show the form to edit an existing user
    public function edit($id)
    {
        $user = DB::selectOne("SELECT * FROM user_info WHERE id = ?", [$id]);
        return view('admin.users.edit', ['user' => $user]);
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
       // dd('update');
        $request->validate([
            'name' => 'required|string|max:255|unique:user_info,name,',
            'email' => 'required|email|max:255|unique:user_info,email,',
            'role' => 'required|string',
        ]);

        //dd('update');

        DB::update("UPDATE user_info SET name = ?, email = ?, roles = ?, updated_at = NOW() WHERE id = ?", [
            $request->name,
            $request->email,
            $request->role,
            $id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function destroy($id)
    {
        DB::delete("DELETE FROM user_info WHERE id = ?", [$id]);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function editRole($id)
    {
        $user = DB::selectOne("SELECT * FROM user_info WHERE id = ?", [$id]);
        return view('admin.users.role', compact('user'));
    }

    // Update user role
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string',
        ]);
        $role = $request->input('role');

    // Update the user's role in the database using a raw SQL query
       DB::update('UPDATE user_info SET roles = ? WHERE id = ?', [$role, $id]);

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }
}
