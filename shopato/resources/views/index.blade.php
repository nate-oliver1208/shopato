@extends('templates.base-template')

@section('header')
    <div class="container">
        <x-searchbar
            :link="route('index')"
        />
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="card-title mb-0">Anúncios recentes</h4>
            </div>
            <div class="card-body">
                @if ($anuncios->count() > 0)
                    <div class="row">
                        @foreach ($anuncios as $anuncio)
                            @php
                                $imagem = '/imagens/anuncios/default.jpg';
                                foreach (['jpg', 'jpeg', 'png'] as $ext) {
                                    $caminho = public_path("imagens/anuncios/{$anuncio->codigo}_img1.$ext");
                                    if (file_exists($caminho)) {
                                        $imagem = "/imagens/anuncios/{$anuncio->codigo}_img1.$ext";
                                        break;
                                    }
                                }
                            @endphp
                            <div class="col-md-4">
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
                    <p>Não há anúncios cadastrados no momento.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
