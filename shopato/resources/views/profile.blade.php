@extends('templates.base-template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @php
                        $foto = '/imagens/usuarios/defaultuser.png';
                        foreach (['jpg', 'jpeg', 'png'] as $ext) {
                            if (file_exists(public_path("imagens/usuarios/usuario_" . Auth::id() . '.' . $ext))) {
                                $foto = "/imagens/usuarios/usuario_" . Auth::id() . '.' . $ext;
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

                    <a href="{{ route('profile.foto') }}" class="btn btn-outline-primary mb-2">
                        <i class="fas fa-camera"></i> Alterar foto de perfil
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Seus dados</h3>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $usuario->email }}</p>
                    <p><strong>Telefone:</strong> {{ $usuario->telefone }}</p>
                    <p><strong>Endereço:</strong> {{ $usuario->rua }}, {{ $usuario->bairro }}, {{ $usuario->cep }}</p>
                    <a href="{{ route('anunciar') }}" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i> Publicar novo anúncio
                    </a>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Seus anúncios</h3>
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
                        <p>Você ainda não possui anúncios cadastrados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
