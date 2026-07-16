<?php
  if (!defined('BASE_URL')) {
      define('BASE_URL', ''); // ajuste se necessário
  }
  include 'data/connection.php';
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nome = $_POST['nome'];
      $sobrenome = $_POST['sobrenome'];
      $email = $_POST['email'];
      $senha = $_POST['senha'];
      $cpf = $_POST['cpf'];
      $cep = $_POST['cep'];
      $rua = $_POST['rua'];
      $bairro = $_POST['bairro'];
      $cidade = $_POST['cidade'];
      $uf = $_POST['uf'];
      $telefone = $_POST['telefone'];

      $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, cpf, cep, rua, bairro, cidade, uf, telefone, anuncios, criado_em)
              VALUES ('$nome', '$sobrenome', '$email', '$senha', '$cpf', '$cep', '$rua', '$bairro', '$cidade', '$uf', '$telefone', 0, NOW())";

      if ($conn->query($sql) === TRUE) {
          $id_usuario = $conn->insert_id;

          if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
              $permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
              $tipo = $_FILES['foto']['type'];
              $tamanho = $_FILES['foto']['size'];

              if (in_array($tipo, $permitidos) && $tamanho <= 100 * 1024) {
                  $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                  $destino = "imagens/usuarios/usuario_{$id_usuario}." . $ext;
                  move_uploaded_file($_FILES['foto']['tmp_name'], $destino);
              }
          }

          echo "<div class='alert alert-success mt-4 text-center'>Cadastro realizado com sucesso. <a href='login.php'>Clique aqui para fazer login</a>.</div>";
          exit();
      } else {
          $erro = "Erro ao cadastrar: " . $conn->error;
      }
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro</title>

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
            <div class="col-md-8">
              <div class="card card-warning mt-4">
                <div class="card-header text-center">
                  <h3 class="card-title">Criar uma conta no Shopato</h3>
                </div>
                <div class="card-body">
                  <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?php echo $erro; ?></div>
                  <?php endif; ?>

                  <form method="POST" action="signin.php" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Sobrenome</label>
                        <input type="text" name="sobrenome" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>CPF</label>
                        <input type="text" name="cpf" class="form-control" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>CEP</label>
                        <input type="text" name="cep" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Rua</label>
                        <input type="text" name="rua" class="form-control" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Bairro</label>
                        <input type="text" name="bairro" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Cidade</label>
                        <input type="text" name="cidade" class="form-control" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>UF</label>
                        <input type="text" name="uf" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Telefone</label>
                      <input type="text" name="telefone" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label>Foto de Perfil (opcional, JPG/PNG, até 100KB)</label>
                      <input type="file" name="foto" class="form-control-file" accept="image/png, image/jpeg, image/jpg">
                    </div>

                    <button type="submit" class="btn btn-warning btn-block">Cadastrar</button>
                  </form>
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
