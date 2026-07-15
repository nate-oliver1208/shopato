<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Anuncio;

class ProfileController extends Controller
{
    public function show()
    {
        $usuario = Auth::user();
        $anuncios = Anuncio::where('codigo', 'like', $usuario->id . '-%')->get();

        return view('profile', compact('usuario', 'anuncios'));
    }

    public function editFoto()
    {
        return view('editar-foto');
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:100',
        ]);

        $foto = $request->file('foto');
        $usuarioId = Auth::id();

        $ext = $foto->getClientOriginalExtension();
        $destino = public_path('imagens/usuarios/usuario_' . $usuarioId . '.' . $ext);

        // Remove arquivos antigos se existirem
        foreach (['jpg', 'jpeg', 'png'] as $extAntigo) {
            $caminhoAntigo = public_path("imagens/usuarios/usuario_" . $usuarioId . '.' . $extAntigo);
            if (file_exists($caminhoAntigo)) {
                unlink($caminhoAntigo);
            }
        }

        // Salva a nova imagem
        $foto->move(public_path('imagens/usuarios'), 'usuario_' . $usuarioId . '.' . $ext);

        return redirect()->route('profile.foto')->with('success', 'Foto de perfil atualizada com sucesso!');
    }

}
