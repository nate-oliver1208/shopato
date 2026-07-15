<div class="card mb-3">
    <img src="{{ $imagem }}" class="card-img-top" alt="Imagem do Produto" style="max-height: 200px; object-fit: cover;">
    <div class="card-body">
        <h5 class="card-title">{{ $titulo }}</h5>
        <p class="card-text">R$ {{ number_format($preco, 2, ',', '.') }}</p>
        <a href="{{ $link }}" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-eye"></i> Ver mais
        </a>
    </div>
</div>