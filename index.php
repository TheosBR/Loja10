<?php
session_start();
// CONEXÃO COM BANCO
$conn = new mysqli("localhost", "root", "1234", "loja10");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// WhatsApp
$telefone = "5583998776565";

// Função WhatsApp
function gerarLink($telefone, $produto, $preco){
    $mensagem = "Olá, quero comprar:\n";
    $mensagem .= "Produto: $produto\n";
    $mensagem .= "Preço: R$ $preco";

    return "https://wa.me/$telefone?text=" . urlencode($mensagem);
}

// BUSCAR PRODUTOS DO BANCO
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <title>Loja10</title>
    <link rel="stylesheet" href="style_index.css">
</head>
<body>

<header>
    <h1>🛒 Loja10</h1>

    <!-- BOTÃO DE CADASTRO -->
    <a href="cadastro.php" class="btn-cadastro">Cadastrar Usuário</a>
    <!-- BOTÃO DE ADICIONAR PRODUTO -->
    <a href="login_admin.php" class="btn-cadastro">+ Produto</a>
</header>

<div class="container">

<?php while($row = $result->fetch_assoc()) { ?>

    <div class="produto">
        <img src="<?php echo $row['imagem']; ?>">

        <h3><?php echo $row['nome']; ?></h3>
        <p>R$ <?php echo $row['preco']; ?></p>

        <a href="<?php echo gerarLink($telefone, $row['nome'], $row['preco']); ?>">
            <button>Comprar</button>
        </a>
        
        <?php if(isset($_SESSION['admin_logado'])) { ?>
        <form method="POST" action="deletar_produto.php" onsubmit="return confirm('Tem certeza que deseja excluir?');">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button style="background:red;">Excluir</button>
        </form>
        <?php } ?>

    </div>

    
    

<?php } ?>

</div>

</body>
</html>