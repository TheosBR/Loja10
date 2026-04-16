<?php
session_start();

$conn = new mysqli("localhost", "root", "1234", "loja10");

// SENHA DO ADMIN
$senha_admin = "123";

// SE NÃO ESTIVER LOGADO
if (!isset($_SESSION['admin_logado'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['senha'])) {

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
}
?>

<?php

// =====================
// CADASTRO DE PRODUTO
// =====================

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    $imagem = $_FILES['imagem'];

    $pasta = "Imagem/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    $nomeImagem = uniqid() . "_" . $imagem['name'];
    $caminho = $pasta . $nomeImagem;

    if (move_uploaded_file($imagem['tmp_name'], $caminho)) {

        $sql = "INSERT INTO produtos (nome, preco, imagem)
                VALUES ('$nome', '$preco', '$caminho')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Produto cadastrado com sucesso!');</script>";
        } else {
            echo "Erro: " . $conn->error;
        }

    } else {
        echo "Erro ao enviar imagem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="style_prod.css">
</head>
<body>

<!-- HEADER -->
<header>
    <h1>🛒 Loja10</h1>
    <div>
        <a href="index.php" class="btn-cadastro">Loja</a>
        <a href="logout.php" class="btn-cadastro" style="background:red;">Sair</a>
    </div>
</header>

<!-- FORM -->
<div class="form">
    <h2>➕ Adicionar Produto</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Nome do produto" required>

        <input type="number" step="0.01" name="preco" placeholder="Preço (R$)" required>
        
        <input type="file" name="imagem" required>

        <button type="submit">Adicionar Produto</button>
    </form>

    <a href="index.php" class="voltar">⬅ Voltar para loja</a>
</div>

</body>
</html>