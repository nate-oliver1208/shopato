<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class SigninController extends Controller
{
    public function show()
    {
        return view('signin');
    }

    public function store(Request $request)
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

        $usuario = Usuario::create([
            ...$dados,
            'anuncios' => 0,
            'criado_em' => now(),
        ]);

        // Processamento da imagem de perfil (opcional)
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $foto = $request->file('foto');
            if ($foto->getSize() <= 100 * 1024) {
                $ext = $foto->getClientOriginalExtension();
                $foto->move(public_path('imagens/usuarios'), 'usuario_' . $usuario->id . '.' . $ext);
            }
        }

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso.');
    }
}
