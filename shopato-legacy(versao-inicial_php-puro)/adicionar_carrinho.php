<?php
    include 'data/connection.php';
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }

    $id_usuario = (int) $_SESSION['id'];
    $id_anuncio = (int) $_POST['id_anuncio'];
    $quantidade = max(1, (int) $_POST['quantidade']);

    // Verifica se o item já está no carrinho
    $sql = "SELECT * FROM carrinho WHERE id_usuario = $id_usuario AND id_anuncio = $id_anuncio";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $sql = "UPDATE carrinho SET quantidade = quantidade + $quantidade WHERE id_usuario = $id_usuario AND id_anuncio = $id_anuncio";
    } else {
        $sql = "INSERT INTO carrinho (id_usuario, id_anuncio, quantidade) VALUES ($id_usuario, $id_anuncio, $quantidade)";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: carrinho.php');
        exit();
    } else {
        echo "Erro ao adicionar ao carrinho: " . $conn->error;
    }
?>
