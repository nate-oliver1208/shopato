@extends('templates.base-template')

@section('header')
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="card-title mb-0"><strong>{{ $anuncio->titulo }}</strong></h4>
            </div>
            <div class="card-body">
                @php
                    $imagens = [];
                    for ($i = 1; $i <= 3; $i++) {
                        foreach (['jpg', 'jpeg', 'png'] as $ext) {
                            $caminho = public_path("imagens/anuncios/{$anuncio->codigo}_img{$i}.$ext");
                            if (file_exists($caminho)) {
                                $imagens[] = "/imagens/anuncios/{$anuncio->codigo}_img{$i}.$ext";
                                break;
                            }
                        }
                    }
                @endphp

                @if (count($imagens) > 0)
                    <div class="row mb-3">
                        @foreach ($imagens as $img)
                            <div class="col-md-4">
                                <img src="{{ $img }}" class="img-fluid rounded mb-2" style="max-height: 250px; object-fit: cover;" alt="Imagem do Produto">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p><em>Sem imagens disponíveis para este anúncio.</em></p>
                @endif

                <p><strong>Descrição:</strong><br> {!! nl2br(e($anuncio->descricao)) !!}</p>
                <p><strong>Preço:</strong> R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</p>
                <p><strong>Enviado de:</strong> {{ $anuncio->enviado_de }}</p>
                <p><strong>Anunciado por:</strong> {{ $anuncio->anunciado_por }}</p>

                @php
                    $partes = explode('-', $anuncio->codigo);
                    $id_usuario = $partes[0];
                @endphp

                <a href="{{ route('loja.show', ['id' => $id_usuario]) }}" class="btn btn-outline-primary mb-2">
                    <i class="fas fa-store"></i> Ver loja do vendedor
                </a>

                <form method="GET" action="{{ route('carrinho.adicionar', ['codigo' => $anuncio->codigo]) }}" class="d-inline">
                    <div class="input-group" style="max-width: 150px;">
                        <input type="number" name="quantidade" class="form-control" value="1" min="1" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-cart-plus"></i> Adicionar ao Carrinho
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
