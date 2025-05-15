<?php 
require_once "Conexao.php";
class criaClasses1{
    private $tbBanco = "Tables_in_enderecos";
    private $conn;

    function __construct(){
        $this->conn = (new Conexao())->conectar();
    }

    function ClassesModel(){
        $sql = "SHOW TABLES";
        $query = $this->conn->query($sql);
        $tabelas = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tabelas as $tabela) {
            $nomeTabela = ucfirst($tabela->{$this->tbBanco});
            $conteudo = <<<EOT
class {$nomeTabela} {
}
EOT;
        echo "conteudo:<br><pre>$conteudo</pre><br><br>";
        }
    }
}
(new criaClasses1())->ClassesModel();
?>