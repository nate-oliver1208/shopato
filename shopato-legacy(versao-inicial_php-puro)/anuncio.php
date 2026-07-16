<?php
  if (!defined('BASE_URL')) {
      define('BASE_URL', ''); // ajuste se necessário
  }
  include 'data/connection.php';
  session_start();

  if (!isset($_GET['codigo'])) {
    echo "Anúncio não encontrado.";
    exit();
  }

  $codigo = $_GET['codigo'];
  $sql = "SELECT * FROM anuncios WHERE codigo = '$codigo'";
  $result = $conn->query($sql);

  if (!$result || $result->num_rows === 0) {
    echo "Anúncio não encontrado.";
    exit();
  }

  $anuncio = $result->fetch_assoc();

  // Carrega imagens do produto
  $imagens = [];
  for ($i = 1; $i <= 3; $i++) {
    foreach (['jpg', 'jpeg', 'png'] as $ext) {
      $caminho = "imagens/anuncios/{$codigo}_img{$i}.$ext";
      if (file_exists($caminho)) {
        $imagens[] = $caminho;
        break;
      }
    }
  }

  // Descobre o ID do anunciante
  $partes = explode('-', $codigo);
  $id_usuario = (int) $partes[0];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($anuncio['titulo']); ?></title>

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

          <div class="card mt-3">
            <div class="card-header bg-warning">
              <h3 class="card-title"><?php echo htmlspecialchars($anuncio['titulo']); ?></h3>
            </div>
            <div class="card-body">
              <?php if (count($imagens) > 0): ?>
                <div class="row mb-3">
                  <?php foreach ($imagens as $img): ?>
                    <div class="col-md-4">
                      <img src="<?php echo $img; ?>" alt="Imagem do produto" class="img-fluid rounded mb-2" style="max-height: 240px; object-fit: cover;">
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <p><strong>Descrição:</strong><br><?php echo nl2br(htmlspecialchars($anuncio['descricao'])); ?></p>
              <p><strong>Preço:</strong> R$ <?php echo number_format($anuncio['preco'], 2, ',', '.'); ?></p>
              <p><strong>Enviado de:</strong> <?php echo $anuncio['enviado_de']; ?></p>
              <p><strong>Anunciado por:</strong> <?php echo $anuncio['anunciado_por']; ?></p>

              <a href="loja.php?id=<?php echo $id_usuario; ?>" class="btn btn-outline-primary"><i class="fas fa-store"></i> Ver loja</a>
              <form method="POST" action="adicionar_carrinho.php">
                <input type="hidden" name="id_anuncio" value="<?php echo $anuncio['id']; ?>">
                <input type="number" name="quantidade" value="1" min="1" style="width: 50px;">
                <button type="submit">Adicionar ao carrinho</button>
              </form>
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
