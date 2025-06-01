<?php 

class Conexao {
    private $server = "localhost";
    private $banco ="cinemaDB";
    private $usuario = "root";
    private $senha = "root";

    function conectar(){
        try {
            $conn = new PDO("mysql:host=".$this->server.";dbname=$this->banco;port=3308", $this->usuario, $this->senha);
            return $conn;
        } catch (Exception $e) {
            echo "Erro ao conectar como Banco de Dados : " . $e->getMessage();
        }
    }
}

(new Conexao())->conectar();
?>