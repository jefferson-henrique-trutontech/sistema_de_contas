<?php
include 'classes/database.php';
include 'classes/contas.php';
$db = new Database();
$con = $db ->getCon();
$contas = new Contas($con);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de contas</title>
</head>
<body>
    <h1>Sistema de contas</h1>
    <h2>Bem vindo(a), <?=$_SESSION['usuario']?></h2>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
    <h2>Contas</h2>
    <ul>
        <li>
            <details>
                <summary>Usuário 1 | Entrada: 00/00/0000 | Vencimento: 00/00/0000 | Valor: R$ 0000,00</summary>
                <ul>
                    <li>Produto 1 | R$ 0000,00</li>
                    <li>Produto 2 | R$ 0000,00</li>
                    <li>Produto 3 | R$ 0000,00</li>
                    <li>Produto 4 | R$ 0000,00</li>
                    <li>Produto 5 | R$ 0000,00</li>
                </ul>
            </details>
        </li>
    </ul>
</body>
</html>