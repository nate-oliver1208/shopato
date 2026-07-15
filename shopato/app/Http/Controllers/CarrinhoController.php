<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrinho;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    public function index()
    {
        $itens = Carrinho::where('id_usuario', Auth::id())->with('anuncio')->get();
        return view('carrinho', compact('itens'));
    }

    public function adicionar(Request $request, $codigo)
    {
        $anuncio = Anuncio::where('codigo', $codigo)->firstOrFail();
        $quantidade = $request->get('quantidade', 1);

        $item = Carrinho::where('id_usuario', Auth::id())
                        ->where('id_anuncio', $anuncio->id)
                        ->first();

        if ($item) {
            $item->quantidade += $quantidade;
            $item->save();
        } else {
            Carrinho::create([
                'id_usuario' => Auth::id(),
                'id_anuncio' => $anuncio->id,
                'quantidade' => $quantidade,
                'adicionado_em' => now(),
            ]);
        }

        return redirect()->route('carrinho')->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remover($id)
    {
        $item = Carrinho::where('id', $id)
                        ->where('id_usuario', Auth::id())
                        ->firstOrFail();
        $item->delete();

        return redirect()->route('carrinho')->with('success', 'Item removido do carrinho!');
    }
}
