<?php
  if (!defined('BASE_URL')) {
      define('BASE_URL', ''); // ajuste se necessário
  }
  session_start();
  include 'data/connection.php';

  // Verifica se o usuário está logado
  $logado = isset($_SESSION['id']);
  $nomeUsuario = $logado ? $_SESSION['nome'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sobre</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASE_URL ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="<?= BASE_URL ?>adminlte/dist/css/adminlte.min.css?v=3.2.0">

  <style>
    .brand-link img {
      height: 35px;
      margin-right: 10px;
    }
    .main-header {
      background-color: #ffeb80;
    }
    .content-wrapper {
      background-color: #fffbea;
    }
    footer.main-footer {
      background-color: #ffeb80;
      color: #333;
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light border-bottom">
      <div class="container">
        <a href="index.php" class="navbar-brand">
          <img src="imagens/ducklogodark.png" alt="Shopato Logo" class="brand-image">
          <span class="brand-text font-weight-bold">Shopato</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="index.php" class="nav-link"><i class="fas fa-home"></i> Início</a>
            </li>
            <li class="nav-item">
              <a href="carrinho.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Carrinho</a>
            </li>
            <li class="nav-item">
              <a href="sobre.php" class="nav-link"><i class="fas fa-info-circle"></i> Sobre</a>
            </li>
            <?php if (isset($_SESSION['id'])): ?>
              <li class="nav-item">
                <a href="profile.php" class="nav-link"><i class="fas fa-user"></i> Perfil</a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Sair</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a href="login.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> Entrar</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content pt-4">
        <div class="container">
          <!-- CONTEÚDO DA PÁGINA AQUI -->

          <div class="card">
            <div class="card-header bg-warning">
              <h3 class="card-title">Sobre o Shopato</h3>
            </div>
            <div class="card-body">
              <p>O <strong>Shopato</strong> é uma plataforma de compra e venda desenvolvida para facilitar a conexão entre vendedores e compradores de forma simples e divertida. Criado com fins acadêmicos, o Shopato simula uma experiência real de marketplace, permitindo que usuários cadastrem produtos, gerenciem seus perfis e interajam com a comunidade.</p>

              <p>Nossa identidade foi inspirada na leveza e acessibilidade de plataformas como Mercado Livre, mas com um toque bem-humorado que faz alusão ao nosso mascote: o pato!</p>

              <hr>

              <h4>Avaliações de usuários</h4>
              <ul class="list-unstyled">
                <li class="mb-3">
                  <i class="fas fa-user-circle text-warning"></i> <strong>Juliana M.</strong> — "O Shopato me surpreendeu! Consegui vender meu fone de ouvido em menos de dois dias. Super fácil de usar."
                </li>
                <li class="mb-3">
                  <i class="fas fa-user-circle text-warning"></i> <strong>Ricardo T.</strong> — "Achei um notebook seminovo com ótimo preço. Recomendo muito a plataforma."
                </li>
                <li class="mb-3">
                  <i class="fas fa-user-circle text-warning"></i> <strong>Camila D.</strong> — "Adorei a interface e o mascote. Tudo muito leve e intuitivo. Parabéns aos desenvolvedores!"
                </li>
              </ul>

              <hr>

              <h4>Contato</h4>
              <p>
                <i class="fas fa-envelope"></i> contato@shopato.com.br<br>
                <i class="fas fa-phone"></i> (11) 99999-9999
              </p>
            </div>
          </div>


        </div>
      </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer text-center py-2">
      <strong>Shopato</strong> &copy; <?php echo date('Y'); ?> - Todos os direitos reservados.
      <div>Inspirado em Mercado Livre. Desenvolvido para fins acadêmicos.</div>
    </footer>

  </div>

  <!-- AdminLTE Scripts -->
  <script src="<?= BASE_URL ?>adminlte/plugins/jquery/jquery.min.js"></script>
  <script src="<?= BASE_URL ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE_URL ?>adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
