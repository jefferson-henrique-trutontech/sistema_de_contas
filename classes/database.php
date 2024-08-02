<?php
class Database{
    private $database;

    public function __construct(){
        $base = $_SERVER['DOCUMENT_ROOT'].'/sistema_de_contas';
        $this->database = new PDO("sqlite:$base/teste.db");
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getCon(){
        return $this->database;
    }
}