<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        $users = User::get();

        return response()->json($users);
    }

    public function getOne(Request $request, $usersId)
    {
        $user = User::findOrFail($usersId);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'     => ['required'],
            'email'    => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name'     => $fields['name'],
            'email'    => $fields['email'],
            'password' => $fields['password'],
        ]);

        return response()->json($user);
    }

    public function update(Request $request, $userId)
    {
        $fields = $request->validate([
            'name'     => ['required'],
            'email'    => ['required'],
            'password' => ['required'],
        ]);

        $user = User::findOrFail($userId);
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->password = $fields['password'];
        $user->save();

        return response()->json($user);
    }

    public function delete(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return response()->noContent();
    }
}
