<?php

class Contas{
    private $database;

    public function __construct($database){
        $this->database = $database;
        $this->database->exec("
        CREATE TABLE IF NOT EXISTS contas(
        id_conta INTEGER PRIMARY KEY AUTOINCREMENT,
        telefone VARCHAR(255),
        entrada DATETIME NOT NULL,
        vencimento DATE NOT NULL,
        finalizacao DATETIME NOT NULL,
        cliente VARCHAR(255)
        )");
    }

    public function get_contas(){
        $sql = "SELECT * FROM contas";
        $stmt = $this->database->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_conta($cliente, $vencimento, $entrada){
        $sql = "INSERT INTO contas(entrada, cliente, vencimento) VALUES (:entrada, :cliente, :vencimento)";
        $stmt = $this->database->query($sql);
        $entrada = $entrada ? $entrada = str_replace('T', ' ', $entrada) . ':00' : 'CURRENT_TIMESTAMP';
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':vencimento', $vencimento);
        $stmt->bindParam(':entrada', $entrada);
        $stmt->execute();
        return $this->database->lastInsertId();
    }
}