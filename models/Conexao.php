<?php
class Conexao {
    private $servidor;
    private $porta;
    private $usuario;
    private $senha;
    function __construct($servidor,$porta,$usuario,$senha) {
        $this->servidor = $servidor;
        $this->porta = $porta;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }
    function conectarDb() {
        try {
            $conn = new PDO(
                "mysql:host=" . $this->servidor . ";port=" . $this->porta . ";",
                $this->usuario,
                $this->senha
            );
            return $conn;
        } catch (Exception $e) {
            header("Location:index.php?msg=1&info=" . urlencode($e->getMessage()));
        }
    }
}
?>