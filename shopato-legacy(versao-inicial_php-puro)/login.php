<?php
  if (!defined('BASE_URL')) {
      define('BASE_URL', ''); // ajuste se necessário
  }
  session_start();
  include 'data/connection.php';

  // Se o usuário já estiver logado, redireciona para o perfil
  if (isset($_SESSION['id'])) {
    header("Location: profile.php");
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
  
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);
  
    if ($result && $result->num_rows === 1) {
      $user = $result->fetch_assoc();
      $_SESSION['id'] = $user['id'];
      $_SESSION['nome'] = $user['nome'];
      header('Location: profile.php');
      exit();
    } else {
      $erro = "Email ou senha incorretos.";
    }
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

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

          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="card card-warning mt-4">
                <div class="card-header text-center">
                  <h3 class="card-title">Entrar no Shopato</h3>
                </div>
                <div class="card-body">
                  <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?php echo $erro; ?></div>
                  <?php endif; ?>

                  <form method="POST" action="login.php">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Senha</label>
                      <input type="password" name="senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning btn-block">Entrar</button>
                  </form>

                  <p class="mt-3 text-center">
                    Não tem uma conta? <a href="signin.php">Cadastre-se aqui</a>
                  </p>
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
