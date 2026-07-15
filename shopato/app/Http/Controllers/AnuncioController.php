<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Anuncio;

class AnuncioController extends Controller
{
    public function show($codigo)
    {
        $anuncio = Anuncio::where('codigo', $codigo)->firstOrFail();
        return view('anuncio', compact('anuncio'));
    }

    public function create()
    {
        return view('anunciar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required|max:255',
            'preco' => 'required|numeric|min:0',

            'imagem1' => 'required|image|mimes:jpg,jpeg,png|max:100',
            'imagem2' => 'required|image|mimes:jpg,jpeg,png|max:100',
            'imagem3' => 'required|image|mimes:jpg,jpeg,png|max:100',
        ]);

        $usuario = Auth::user();
        $codigo = $usuario->id . '-' . ($usuario->anuncios + 1);

        // Cria o anúncio no banco
        Anuncio::create([
            'codigo' => $codigo,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'anunciado_por' => $usuario->nome . ' ' . $usuario->sobrenome,
            'enviado_de' => $usuario->cidade . ' - ' . $usuario->uf,
        ]);

        // Processar cada imagem individualmente
        foreach (['imagem1', 'imagem2', 'imagem3'] as $index => $inputName) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $ext = $file->getClientOriginalExtension();
                $file->move(public_path('imagens/anuncios'), "{$codigo}_img" . ($index + 1) . '.' . $ext);
            }
        }

        // Atualiza contador de anúncios do usuário
        $usuario->anuncios += 1;
        $usuario->save();

        return redirect()->route('profile')->with('success', 'Anúncio publicado com sucesso!');
    }


}

