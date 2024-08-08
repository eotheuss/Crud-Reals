<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.read', compact('users'));
    }

    public function create()
    {
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')->json();
        return view('users.create', ['estados' => $estados]);
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
        return redirect()->route('users.read');
    }

    public function edit(User $user)
    {
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')->json();
        return view('users.edit', compact('user', 'estados'));
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
        return redirect()->route('users.read');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.read');
    }

    public function getCidades($estado)
    {
        return Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$estado}/municipios")->json();
    }
}
