<?php
date_default_timezone_set('America/Sao_Paulo');
class Haver{
    private $database;
    public function __construct($database){
        $this->database = $database;
        $this->database->exec("
        CREATE TABLE IF NOT EXISTS haver(
            id_haver INTEGER PRIMARY KEY AUTOINCREMENT,
            valor REAL,
            data DATETIME,
            id_conta INT,
            FOREIGN KEY(id_conta) REFERENCES contas(id_conta)
        )
        ");
    }

    public function insert_haver($valor, $id_conta){
        $stmt = $this->database->prepare("INSERT INTO haver(valor, data, id_conta) VALUES (:valor, CURRENT_TIMESTAMP, :id_conta)");
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':id_conta', $id_conta);
        $stmt->execute();
    }

    public function get_haver($id_conta){
        $stmt = $this->database->query("SELECT * FROM haver WHERE id_conta = $id_conta");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}