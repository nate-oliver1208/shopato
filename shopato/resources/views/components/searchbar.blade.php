<div class="card">
    <div class="card-title alert alert-warning">
        <h3>Bem-vindo{{ Auth::check() ? ', ' . Auth::user()->nome : ' ao Shopato' }}!</h3>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ $link }}" class="form-inline">
            <input type="text" name="busca" class="form-control mr-2" placeholder="Buscar produto..." required>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-search"></i> Pesquisar
            </button>
        </form>
    </div>
</div>