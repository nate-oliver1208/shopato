<?php
  if (!defined('BASE_URL')) {
      define('BASE_URL', ''); // ajuste se necessário
  }
  include 'data/connection.php';
  session_start();

  if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_SESSION['id'];
    $sql = "SELECT sobrenome, cidade, uf, anuncios FROM usuarios WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $codigo = $id . "-" . ((int)$row['anuncios'] + 1);
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $preco = floatval($_POST['preco']);
    $anunciado_por = $_SESSION['nome'] . " " . $row['sobrenome'];
    $enviado_de = $row['cidade'] . " - " . $row['uf'];
    $anuncios = (int)$row['anuncios'] + 1;

    $imagens_salvas = [];

    $diretorio = "imagens/anuncios/";
    if (!file_exists($diretorio)) {
      mkdir($diretorio, 0777, true); // cria o diretório se não existir
    }

    $tipos_permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
    $tamanho_maximo = 100 * 1024; // 100 KB

    for ($i = 0; $i < 3; $i++) {
      if (isset($_FILES['imagens']['error'][$i]) && $_FILES['imagens']['error'][$i] === UPLOAD_ERR_OK) {
        $tipo = $_FILES['imagens']['type'][$i];
        $tamanho = $_FILES['imagens']['size'][$i];
        $tmp_name = $_FILES['imagens']['tmp_name'][$i];

        if (!in_array($tipo, $tipos_permitidos)) {
          die("Erro: Tipo de imagem inválido.");
        }

        if ($tamanho > $tamanho_maximo) {
          die("Erro: Uma das imagens excede 100 KB.");
        }

        // Gera nome único com base no código do anúncio
        $ext = pathinfo($_FILES['imagens']['name'][$i], PATHINFO_EXTENSION);
        $nome_arquivo = $codigo . "_img" . ($i+1) . "." . $ext;
        $destino = $diretorio . $nome_arquivo;

        if (move_uploaded_file($tmp_name, $destino)) {
          $imagens_salvas[] = $nome_arquivo;
        } else {
          die("Erro ao salvar a imagem " . ($i+1));
        }
      } else {
        die("Erro no upload da imagem " . ($i+1));
      }
    }

    $sql = "INSERT INTO anuncios (codigo, titulo, descricao, preco, anunciado_por, enviado_de)
            VALUES ('$codigo', '$titulo', '$descricao', '$preco', '$anunciado_por', '$enviado_de')";

    $sql1 = "UPDATE usuarios SET anuncios='$anuncios' WHERE id='$id'";

    if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
      echo "Anúncio publicado com sucesso!";
      header("Location: profile.php");
      exit();
    } else {
      echo "<div class='alert alert-danger mt-3'>Erro ao publicar o anúncio: " . $conn->error . "</div>";
    }
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopato</title>

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
                <div class="card-header">
                  <h3 class="card-title">Anunciar Produto</h3>
                </div>
                <div class="card-body">
                  <form action="anunciar.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="titulo">Título:</label>
                      <input type="text" id="titulo" name="titulo" class="form-control" maxlength="255" required>
                    </div>

                    <div class="form-group">
                      <label for="descricao">Descrição:</label>
                      <textarea id="descricao" name="descricao" maxlength="255" rows="4" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="preco">Preço (R$):</label>
                      <input type="number" id="preco" name="preco" class="form-control" step="0.01" min="0" required>
                    </div>

                    <div class="form-group">
                      <label>Imagens do produto (3 imagens - JPG/PNG - max 100KB cada):</label>
                      <input type="file" name="imagens[]" class="form-control-file" accept=".jpg,.jpeg,.png" required><br>
                      <input type="file" name="imagens[]" class="form-control-file" accept=".jpg,.jpeg,.png" required><br>
                      <input type="file" name="imagens[]" class="form-control-file" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <button type="submit" class="btn btn-warning btn-block">Cadastrar Produto</button>
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
