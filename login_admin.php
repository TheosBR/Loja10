<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

$senha_admin = "123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['senha'] === $senha_admin) {
        $_SESSION['admin_logado'] = true;

        header("Location: adicionar_produto.php");
        exit;
    } else {
        $erro = "Senha incorreta!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>

<!-- HEADER -->
<header>
    <h1>🛒 Loja10</h1>
    <a href="index.php" class="btn-cadastro">Voltar</a>
</header>

<!-- LOGIN -->
<div class="form">
    <h2>🔐 Área do Administrador</h2>

    <?php if(isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

    <form method="POST">
        <input type="password" name="senha" placeholder="Digite a senha" required>
        <button type="submit">Entrar</button>
    </form>

    <a href="index.php" class="voltar">⬅ Voltar para loja</a>
</div>

</body>
</html>

<?php   
exit;

?>