<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Exibe a página de login
    public function showLogin()
    {
        return view('login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        // Buscar o usuário
        $usuario = Usuario::where('email', $request->email)->first();

        if ($usuario && $usuario->senha === $request->senha) {
            // Login simples, sem hash
            Auth::login($usuario);
            return redirect()->route('profile');
        }

        // Caso queira usar senha criptografada:
        /*
        if ($usuario && Hash::check($request->senha, $usuario->senha)) {
            Auth::login($usuario);
            return redirect()->route('profile');
        }
        */

        return redirect()->route('login')->with('erro', 'Email ou senha incorretos.');
    }

    // Exibe a página de cadastro
    public function showSignin()
    {
        return view('signin');
    }

    // Processa o cadastro
    public function signin(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required',
            'sobrenome' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required',
            'cpf' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'telefone' => 'required',
        ]);

        // Criação do usuário
        $usuario = Usuario::create([
            ...$dados,
            //'senha' => bcrypt($request->senha), // Caso queira usar hash
            'anuncios' => 0,
            'criado_em' => now(),
        ]);

        // Upload da foto de perfil (opcional)
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $foto = $request->file('foto');
            if ($foto->getSize() <= 100 * 1024) {
                $ext = $foto->getClientOriginalExtension();
                $foto->move(public_path('imagens/usuarios'), 'usuario_' . $usuario->id . '.' . $ext);
            }
        }

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
    }

    // Processa o logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
