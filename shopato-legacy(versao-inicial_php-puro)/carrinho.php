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
  $id_usuario = (int) $_SESSION['id'];
  
  // Remoção de item do carrinho
  if (isset($_GET['remover'])) {
    $id_carrinho = (int) $_GET['remover'];
    $conn->query("DELETE FROM carrinho WHERE id = $id_carrinho AND id_usuario = $id_usuario");
    header("Location: carrinho.php");
    exit();
  }

  $sql = "SELECT c.id AS carrinho_id, a.codigo, a.titulo, a.preco, c.quantidade
          FROM carrinho c
          JOIN anuncios a ON c.id_anuncio = a.id
          WHERE c.id_usuario = $id_usuario";
  $result = $conn->query($sql);

  $itens = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
  $total = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meu Carrinho</title>

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

          <div class="card mt-4">
            <div class="card-header bg-warning">
              <h3 class="card-title">Seu Carrinho</h3>
            </div>
            <div class="card-body">
              <?php if (count($itens) > 0): ?>
                <table class="table table-bordered">
                  <thead class="bg-light">
                    <tr>
                      <th>Produto</th>
                      <th>Imagem</th>
                      <th>Preço</th>
                      <th>Quantidade</th>
                      <th>Subtotal</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($itens as $item): ?>
                      <?php
                        $imagem = 'imagens/anuncios/default.jpg';
                        foreach (['jpg', 'jpeg', 'png'] as $ext) {
                          $caminho = "imagens/anuncios/{$item['codigo']}_img1.$ext";
                          if (file_exists($caminho)) {
                            $imagem = $caminho;
                            break;
                          }
                        }
                        $subtotal = $item['preco'] * $item['quantidade'];
                        $total += $subtotal;
                      ?>
                      <tr>
                        <td><?php echo $item['titulo']; ?></td>
                        <td><img src="<?php echo $imagem; ?>" alt="Produto" width="60"></td>
                        <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $item['quantidade']; ?></td>
                        <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                        <td>
                          <a href="carrinho.php?remover=<?php echo $item['carrinho_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remover este item?')">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="4" class="text-right">Total:</th>
                      <th colspan="2">R$ <?php echo number_format($total, 2, ',', '.'); ?></th>
                    </tr>
                  </tfoot>
                </table>
              <?php else: ?>
                <p>Seu carrinho está vazio.</p>
              <?php endif; ?>
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
