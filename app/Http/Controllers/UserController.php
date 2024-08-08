<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cpf' => 'required|unique:users',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'cpf' => 'required|unique:users,cpf,' . $user->id,
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);

        $user->update($request->all());
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
