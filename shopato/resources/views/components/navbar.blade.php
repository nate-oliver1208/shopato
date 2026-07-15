<nav class="main-header navbar navbar-expand-md navbar-light border-bottom">
      <div class="container">
        <a href="/" class="navbar-brand">
          <img src="/imagens/ducklogodark.png" alt="Logo" class="brand-image">
          <span class="brand-text font-weight-bold">Shopato</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="/" class="nav-link"><i class="fas fa-home"></i> Início</a>
            </li>
            <li class="nav-item">
              <a href="/carrinho" class="nav-link"><i class="fas fa-shopping-cart"></i> Carrinho</a>
            </li>
            <li class="nav-item">
              <a href="/sobre" class="nav-link"><i class="fas fa-info-circle"></i> Sobre</a>
            </li>
            @auth
              <li class="nav-item">
                <a href="/profile" class="nav-link"><i class="fas fa-user"></i> Perfil</a>
              </li>
              <li class="nav-item">
                <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Sair</a>
              </li>
            @else
              <li class="nav-item">
                <a href="/login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Entrar</a>
              </li>
            @endauth
          </ul>
        </div>
      
    </nav>