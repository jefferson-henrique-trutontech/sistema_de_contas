<?php
include '../../classes/contas.php';
include '../../classes/database.php';
include '../../classes/produtos.php';
$db = new Database();
$con = $db->getCon();
$conta = new Contas($con);
$produtos = new Produtos($con);

print_r($_POST);
$id_conta = $conta->insert_conta($_POST['nome'], $_POST['vencimento'], $_POST['entrada']);

foreach($_POST['nome_produto'] as $indice => $nome_produto){
    $valor_produto = $_POST['valor_produto'][$indice];
    $produtos->inserir_produto($id_conta, $nome_produto, $valor_produto);
}

echo "Inserido com sucesso!";