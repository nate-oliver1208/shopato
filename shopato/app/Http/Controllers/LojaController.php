<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Anuncio;

class LojaController extends Controller
{
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        $anuncios = Anuncio::where('codigo', 'like', $id . '-%')->get();

        return view('loja', compact('usuario', 'anuncios'));
    }
}
