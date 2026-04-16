<?php
session_start();

// SE NÃO FOR ADMIN → BLOQUEIA
if (!isset($_SESSION['admin_logado'])) {
    die("Acesso negado!");
}

$conn = new mysqli("localhost", "root", "1234", "loja10");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];

    // Primeiro pega a imagem
    $sql = "SELECT imagem FROM produtos WHERE id = $id";
    $result = $conn->query($sql);
    $produto = $result->fetch_assoc();

    // Deleta a imagem da pasta
    if (file_exists($produto['imagem'])) {
        unlink($produto['imagem']);
    }

    // Deleta do banco
    $sql = "DELETE FROM produtos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro ao excluir";
    }
}
?>