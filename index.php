<?php
session_start();
if (isset($_SESSION['usuario']) & isset($_SESSION['senha'])) {
    include "paginas/inicio.php";
} else {
    if (isset($_POST['usuario']) & isset($_POST['senha'])) {
        if($_POST['usuario'] == 'cleomar' & $_POST['senha'] == '123'){
            $_SESSION['usuario'] = $_POST['usuario'];
            $_SESSION['senha'] = $_POST['senha'];
            include "paginas/inicio.php";
        }else{
            header('Location: login.php?w=Erro ao logar!');
        }
    }else{
        header('Location: login.php');
    }
}
