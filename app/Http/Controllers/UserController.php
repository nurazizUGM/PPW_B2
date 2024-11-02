<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'level' => 'required|in:USER,ADMIN',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $data['photo'] = $photo->storeAs('profile', $photo->hashName(), 'public');
        }

        User::create($data);
        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|confirmed',
            'level' => 'required|in:ADMIN,USER',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $data['photo'] = $photo->storeAs('profile', $photo->hashName(), 'public');
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }
        }

        User::where('id', $id)->update($data);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->photo && Storage::exists('public/' . $user->photo)) {
            Storage::delete('public/' . $user->photo);
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
