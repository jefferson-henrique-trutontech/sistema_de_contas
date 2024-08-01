<?php

class Contas{
    private $database;

    public function __construct($database){
        $this->database = $database;
        $this->database->exec("
        CREATE TABLE IF NOT EXISTS contas(
        id_conta INTEGER PRIMARY KEY AUTOINCREMENT,
        descricao TEXT NOT NULL,
        entrada DATETIME NOT NULL,
        finalizacao DATETIME NOT NULL
        )");
    }
}