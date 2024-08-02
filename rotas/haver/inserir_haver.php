<?php
include "../../classes/database.php";
include "../../classes/haver.php";

$database = new Database();
$con = $database->getCon();
$haver = new Haver($con);

$valor = $_POST['valor'];
$id_conta = $_POST['id_conta'];

$haver->insert_haver($valor, $id_conta);