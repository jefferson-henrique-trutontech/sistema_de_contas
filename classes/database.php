<?php
class Database{
    private $database;

    public function __construct(){
        $this->database = new PDO('sqlite:teste.db');
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getCon(){
        return $this->database;
    }
}