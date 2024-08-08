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
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            ->failed(function ($response) {
                abort(500, 'Falha ao carregar estados.');
            })
            ->json();

        return view('users.create', ['estados' => $estados]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:users',
            'data-nascimento' => 'required|date',
            'email' => 'required|email|unique:users',
            'telefone' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.read');
    }

    public function edit(User $user)
    {
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            ->failed(function ($response) {
                abort(500, 'Falha ao carregar estados.');
            })
            ->json();

        return view('users.edit', compact('user', 'estados'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:users,cpf,' . $user->id,
            'data-nascimento' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefone' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
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
        $cidades = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$estado}/municipios")
            ->failed(function ($response) {
                abort(500, 'Falha ao carregar cidades.');
            })
            ->json();

        return $cidades;
    }
}
