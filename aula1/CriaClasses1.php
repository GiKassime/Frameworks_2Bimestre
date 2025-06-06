<?php
include "Conexao.php";

class CriaClasses1
{
    private $con;

    function __construct()
    {
        $this->con = (new Conexao())->conectar(); //Estabelecer conexão com o bdd
    }

    function ClassesModel()
    {
        if (!file_exists("sistema")) {
            mkdir("sistema");
        }
        if (!file_exists("sistema/model")) {
            mkdir("sistema/model");
        }
        $sql = "SHOW TABLES";
        $query = $this->con->query($sql);
        $tabelas = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($tabelas as $tabela) {
            $nomeTabela = array_values((array) $tabela)[0] ;
            $sql = "show columns from ".$nomeTabela;
            $atributos = $this->con->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $nomeAtributos="";
            $getESetters = "";
            foreach($atributos as $atributo){
                $nomeAtributos.="private \${$atributo->Field};\n";
                $getESetters .="\npublic function get".ucfirst($atributo->Field)."(){\n  return \$this->{$atributo->Field};\n}\n";
                $getESetters .="\npublic function set".ucfirst($atributo->Field)."(\${$atributo->Field}){\n  \$this->{$atributo->Field}=\${$atributo->Field};\n}\n";
            }
            $nomeTabela=ucfirst($nomeTabela);
            $conteudo = <<<EOT
<?php
class {$nomeTabela} {
{$nomeAtributos}
{$getESetters}
}
?>
EOT;    
            file_put_contents("sistema/model/{$nomeTabela}.php", $conteudo);

            echo "conteudo:<br><pre>$conteudo</pre><br><br>";
        }
    }
}

(new CriaClasses1())->ClassesModel();
