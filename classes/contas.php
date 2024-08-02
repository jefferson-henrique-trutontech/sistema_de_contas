<?php
date_default_timezone_set('America/Sao_Paulo');

class Contas{
    private $database;

    public function __construct($database){
        $this->database = $database;
        $this->database->exec("
        CREATE TABLE IF NOT EXISTS contas(
        id_conta INTEGER PRIMARY KEY AUTOINCREMENT,
        entrada DATE,
        vencimento DATE,
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
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':vencimento', $vencimento);
        $stmt->bindParam(':entrada', $entrada);
        $stmt->execute();
        return $this->database->lastInsertId();
    }

    public function get_conta($id_conta){
        $sql = "SELECT * FROM contas WHERE id_conta = $id_conta";
        $stmt = $this->database->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function somar_haver($id_conta){
        $sql = "SELECT SUM(valor) AS soma FROM haver WHERE id_conta = $id_conta";
        $stmt = $this->database->query($sql);
        // $stmt->bindParam(':id_conta', $id_conta);
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['soma'];
    }
}