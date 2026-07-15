@extends('templates.base-template')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-warning">
            <h4 class="card-title mb-0">Seu Carrinho</h4>
        </div>

        <div class="card-body">
            @if($itens->count() > 0)
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Imagem</th>
                            <th>Produto</th>
                            <th>Preço Unitário</th>
                            <th>Quantidade</th>
                            <th>Subtotal</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($itens as $item)
                            @php
                                $subtotal = $item->anuncio->preco * $item->quantidade;
                                $total += $subtotal;

                                $imagem = '/imagens/anuncios/default.jpg';
                                foreach (['jpg', 'jpeg', 'png'] as $ext) {
                                    if (file_exists(public_path("imagens/anuncios/{$item->anuncio->codigo}_img1.$ext"))) {
                                        $imagem = "/imagens/anuncios/{$item->anuncio->codigo}_img1.$ext";
                                        break;
                                    }
                                }
                            @endphp
                            <tr>
                                <td><img src="{{ $imagem }}" alt="Imagem" style="width: 80px; height: 80px; object-fit: cover;" class="rounded"></td>
                                <td>{{ $item->anuncio->titulo }}</td>
                                <td>R$ {{ number_format($item->anuncio->preco, 2, ',', '.') }}</td>
                                <td>{{ $item->quantidade }}</td>
                                <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('carrinho.remover', $item->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Remover
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td colspan="2"><strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p>Seu carrinho está vazio.</p>
            @endif

            <div class="mt-3 text-center">
                <a href="{{ route('index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Continuar comprando
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
