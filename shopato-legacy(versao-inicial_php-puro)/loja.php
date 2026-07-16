<?php
  if (!defined('BASE_URL')) {
      define('BASE_URL', ''); // ajuste se necessário
  }
  include 'data/connection.php';
  session_start();

  if (!isset($_GET['id'])) {
      echo "Loja não encontrada.";
      exit();
  }

  $id = (int) $_GET['id'];
  $sql = "SELECT * FROM usuarios WHERE id = $id";
  $result = $conn->query($sql);

  if (!$result || $result->num_rows === 0) {
      echo "Loja não encontrada.";
      exit();
  }

  $usuario = $result->fetch_assoc();
  $sqlAnuncios = "SELECT * FROM anuncios WHERE anunciado_por = '{$usuario['nome']} {$usuario['sobrenome']}' ORDER BY criado_em DESC";
  $resAnuncios = $conn->query($sqlAnuncios);
  $anuncios = $resAnuncios ? $resAnuncios->fetch_all(MYSQLI_ASSOC) : [];

  // Foto do perfil do vendedor
  $fotoPerfil = "imagens/usuarios/defaultuser.png";
  foreach (['jpg', 'jpeg', 'png'] as $ext) {
      $caminho = "imagens/usuarios/usuario_{$id}.{$ext}";
      if (file_exists($caminho)) {
          $fotoPerfil = $caminho;
          break;
      }
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Loja de <?php echo $usuario['nome']; ?></title>

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

          <div class="row">
            <div class="col-md-4">
              <div class="card text-center">
                <div class="card-body">
                  <img src="<?php echo $fotoPerfil; ?>" alt="Foto do vendedor" class="img-circle mb-3" width="120" height="120">
                  <h5><?php echo $usuario['nome'] . ' ' . $usuario['sobrenome']; ?></h5>
                  <p><?php echo $usuario['cidade'] . ' - ' . $usuario['uf']; ?></p>
                  <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
                  <p><strong>Telefone:</strong> <?php echo $usuario['telefone']; ?></p>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Anúncias do vendedor</h3>
                </div>
                <div class="card-body">
                  <?php if (count($anuncios) > 0): ?>
                    <div class="row">
                      <?php foreach ($anuncios as $anuncio): ?>
                        <?php
                          $imagem = 'imagens/anuncios/default.jpg';
                          foreach (['jpg', 'jpeg', 'png'] as $ext) {
                              $caminho = "imagens/anuncios/{$anuncio['codigo']}_img1.$ext";
                              if (file_exists($caminho)) {
                                  $imagem = $caminho;
                                  break;
                              }
                          }
                        ?>
                        <div class="col-md-6">
                          <div class="card mb-3">
                            <img src="<?php echo $imagem; ?>" class="card-img-top" alt="Imagem do produto" style="max-height: 200px; object-fit: cover;">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $anuncio['titulo']; ?></h5>
                              <p class="card-text">R$ <?php echo number_format($anuncio['preco'], 2, ',', '.'); ?></p>
                              <a href="anuncio.php?codigo=<?php echo $anuncio['codigo']; ?>" class="btn btn-outline-primary btn-sm">Ver mais</a>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php else: ?>
                    <p>Este vendedor ainda não possui anúncias.</p>
                  <?php endif; ?>
                </div>
              </div>
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
