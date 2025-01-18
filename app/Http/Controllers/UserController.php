<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get(); // Mengambil user beserta role
        return view('users.index', compact('users'));
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|string|exists:roles,name']);
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' =>'required|unique:size_units|max:10',
            'email' => 'required|email',
            'password' =>'required|password' ,
        ]);

        User::create($validate);

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::findOrfail($id);
        return view('users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $users = User::findOrfail($id);

        $validated = $request->validate([
            'name' => 'required|unique:size_units,name,'.$id.'|max:10',
            'email' => 'required|email',
            'password' =>'required|password' ,
        ]);

        $users->update($validated);

        return redirect()->route('users.index')->with('success', 'user updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $users = User::findOrfail($id);
        $users->delete();

        return redirect()->route('users.index')->with('success', 'users deleted successfully!');
    }
}
