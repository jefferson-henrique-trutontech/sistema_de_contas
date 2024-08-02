<?php
class Produtos{
    private $database;
    public function __construct($database){
        $this->database = $database;
        $this->database->exec("
        CREATE TABLE IF NOT EXISTS produtos(
        id_produto INTEGER PRIMARY KEY AUTOINCREMENT,
        nome_produto VARCHAR(255),
        valor REAL,
        entrada DATETIME,
        id_conta INTEGER,
        FOREIGN KEY(id_conta) REFERENCES contas(id_conta)
        )
        ");
    }

    public function inserir_produto($id_conta, $nome_produto, $valor){
        $sql = "INSERT INTO produtos(id_conta, nome_produto, valor, entrada) VALUES(:id_conta, :nome_produto, :valor, CURRENT_TIMESTAMP)";
        $stmt = $this->database->query($sql);
        $stmt->bindParam(':id_conta', $id_conta);
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':valor', $valor);
    }
}