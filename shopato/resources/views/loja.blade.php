@extends('templates.base-template')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    @php
                        $foto = '/imagens/usuarios/defaultuser.png';
                        foreach (['jpg', 'jpeg', 'png'] as $ext) {
                            if (file_exists(public_path("imagens/usuarios/usuario_{$usuario->id}." . $ext))) {
                                $foto = "/imagens/usuarios/usuario_{$usuario->id}." . $ext;
                                break;
                            }
                        }
                    @endphp
                    <x-card-usuario
                                    :foto="$foto" 
                                    :nome="$usuario->nome" 
                                    :sobrenome="$usuario->sobrenome" 
                                    :cidade="$usuario->cidade"
                                    :uf="$usuario->uf"
                    />
                    <p><strong>Email:</strong> {{ $usuario->email }}</p>
                    <p><strong>Telefone:</strong> {{ $usuario->telefone }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Anúncios do vendedor</h3>
                </div>
                <div class="card-body">
                    @if($anuncios->count() > 0)
                        <div class="row">
                            @foreach ($anuncios as $anuncio)
                                @php
                                    $imagem = '/imagens/anuncios/default.jpg';
                                    foreach (['jpg', 'jpeg', 'png'] as $ext) {
                                        if (file_exists(public_path("imagens/anuncios/{$anuncio->codigo}_img1.$ext"))) {
                                            $imagem = "/imagens/anuncios/{$anuncio->codigo}_img1.$ext";
                                            break;
                                        }
                                    }
                                @endphp

                                <div class="col-md-6">
                                    <x-card-anuncio 
                                    :imagem="$imagem" 
                                    :titulo="$anuncio->titulo" 
                                    :preco="$anuncio->preco" 
                                    :link="route('anuncio.show', $anuncio->codigo)" 
                                    />
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Este vendedor não possui anúncios cadastrados no momento.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
