<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }
    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => '',
            'password_confirmation' => 'same:password'
        ]);
        $user = new User;
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input['password'] = bcrypt($request->password);
            $user->password = $input['password'];
        }
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->save();
        return response()->json($user, 201);
    }
    public function show(User $user)
    {
        return response()->json(User::whereId($user->id)->first());
    }
    public function update(Request $request, User $user)
    {
        $input = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => '',
            'password_confirmation' => 'same:password'
        ]);
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input['password'] = bcrypt($request->password);
            $user->password = $input['password'];
        }
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->save();
        return response()->json($user, 201);
    }
    public function destroy(User $user)
    {
        return response()->json($user->delete());
    }
}
