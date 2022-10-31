<?php 

class Conexao
{
    public $mysql;

    public function __construct()
    {
        $this->mysql = new PDO('mysql:host=localhost:3306;dbname=loraagenda', 'root', '');
    }

}