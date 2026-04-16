<?php
session_start();
session_destroy();
header("Location: index.php");
?>
<a href="logout.php" class="voltar">Sair</a>