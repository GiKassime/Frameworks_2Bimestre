<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
class Creator
{
    private $con;
    private $servidor;
    private $banco;
    private $usuario;
    private $porta;
    private $senha;
    private $tabelas;

    function __construct()
    {
        $this->criaDiretorios();
        $this->conectar();
        $this->buscaTabelas();
        $this->ClassesModel();
        $this->ClasseConexao();
        $this->ClassesControl();
        $this->classesView();
        $this->criaEstilo();
        $this->compactar();
        header("Location:index.php?msg=4");
    }
    function criaDiretorios()
    {
        $dirs = [
            "sistema",
            "sistema/model",
            "sistema/control",
            "sistema/view",
            "sistema/dao",
            "sistema/styles",
        ];

        foreach ($dirs as $dir) {
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0777, true)) {
                    header("Location:index.php?msg=0");
                }
            }
        }
    }
    function conectar()
    {
        $this->servidor = $_POST["servidor"];
        $this->banco = $_POST["banco"];
        $this->usuario = $_POST["usuario"];
        $this->senha = $_POST["senha"];
        $this->porta = $_POST["porta"];
        try {
            $this->con = new PDO(
                "mysql:host=" . $this->servidor . ";port=" . $this->porta . ";dbname=" . $this->banco,
                $this->usuario,
                $this->senha
            );
        } catch (Exception $e) {
            header("Location:index.php?msg=1");
        }
    }
    function buscaTabelas()
    {
        try {
            $sql = "SHOW TABLES";
            $query = $this->con->query($sql);
            $this->tabelas = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            header("Location:index.php?msg=2&info=" . urlencode($e->getMessage()));
        }
    }
    function buscaAtributos($nomeTabela)
    {
        $sql = "show columns from " . $nomeTabela;
        $atributos = $this->con->query($sql)->fetchAll(PDO::FETCH_OBJ);
        return $atributos;
    }
    function ClassesModel()
    {
        foreach ($this->tabelas as $tabela) {
            $nomeTabela = array_values((array) $tabela)[0];
            $atributos = $this->buscaAtributos($nomeTabela);
            $nomeAtributos = "";
            $geters_seters = "";
            foreach ($atributos as $atributo) {
                $atributo = $atributo->Field;
                $nomeAtributos .= "\tprivate \${$atributo};\n";
                $metodo = ucfirst($atributo);
                $geters_seters .= "\tfunction get" . $metodo . "(){\n";
                $geters_seters .= "\t\treturn \$this->{$atributo};\n\t}\n";
                $geters_seters .= "\tfunction set" . $metodo . "(\${$atributo}){\n";
                $geters_seters .= "\t\t\$this->{$atributo}=\${$atributo};\n\t}\n";
            }
            $nomeTabela = ucfirst($nomeTabela);
            $conteudo = <<<EOT
<?php
class {$nomeTabela} {
{$nomeAtributos}
{$geters_seters}
}
?>
EOT;
            file_put_contents("sistema/model/{$nomeTabela}.php", $conteudo);
        }
    }
    function classesView()
    {
        foreach ($this->tabelas as $tabela) {
            $nomeTabela = array_values((array) $tabela)[0];
            $atributos = $this->buscaAtributos($nomeTabela);
            $formCampos = "";
            foreach ($atributos as $atributo) {
                $tipo = $atributo->Type; // Aqui pega o tipo do campo do banco!
                $inputTipo = "text";
                $cont = "";

                if (stripos($tipo, 'int') !== false) {
                    $inputTipo = "number";
                } elseif (stripos($tipo, 'float') !== false || stripos($tipo, 'double') !== false || stripos($tipo, 'decimal') !== false) {
                    $inputTipo = "number";
                    $cont = " step='any'";
                } elseif (stripos($tipo, 'date') !== false) {
                    $inputTipo = "date";
                } elseif (stripos($tipo, 'time') !== false && stripos($tipo, 'date') === false) {
                    $inputTipo = "time";
                } elseif (stripos($tipo, 'char') !== false || stripos($tipo, 'text') !== false) {
                    $inputTipo = "text";
                }

                $nomeCampo = $atributo->Field;
                $formCampos .= "<label for='campo_{$nomeCampo}'>{$nomeCampo}</label>\n";
                $formCampos .= "<input type='{$inputTipo}' name='campo_{$nomeCampo}' id='campo_{$nomeCampo}'{$cont}><br>\n";
            }
            $conteudo = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de {$nomeTabela}</title>
    <link rel="stylesheet" href="./../styles/views.css">
</head>
<body>
    <form> 
        <h1>Cadastro de {$nomeTabela}</h1>
        {$formCampos}
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
HTML;
            file_put_contents("sistema/view/{$nomeTabela}.php", $conteudo); // Exemplo salvando como arquivo
        }
    }

    function ClasseConexao()
    {
        $conteudo = <<<EOT

<?php
class Conexao {
    private \$server;
    private \$banco;
    private \$usuario;
    private \$senha;
    function __construct() {
        \$this->server = '[Informe aqui o servidor]';
        \$this->banco = '[Informe aqui o seu Banco de dados]';
        \$this->usuario = '[Informe aqui o usuário do banco de dados]';
        \$this->senha = '[Informe aqui a senha do banco de dados]';
    }
    function conectar() {
        try {
            \$conn = new PDO(
                "mysql:host=" . \$this->server . ";dbname=" . \$this->banco,\$this->usuario,
                \$this->senha
            );
            return \$conn;
        } catch (Exception \$e) {
            echo "Erro ao conectar com o Banco de dados: " . \$e->getMessage();
        }
    }
}
?>
EOT;
        file_put_contents("sistema/model/conexao.php", $conteudo);
    }

    function ClassesControl()
    {
        foreach ($this->tabelas as $tabela) {
            $nomeTabela = array_values((array)$tabela)[0];
            $nomeClasse = ucfirst($nomeTabela);
            $conteudo = <<<EOT
<?php
require_once("../model/{$nomeClasse}.php");
require_once("../dao/{$nomeClasse}Dao.php");
class {$nomeClasse}Control {
    private \${$nomeTabela};
    private \$acao;
    private \$dao;
    public function __construct(){
       \$this->{$nomeTabela}=new {$nomeClasse}();
      \$this->dao=new {$nomeClasse}Dao();
      \$this->acao=\$_GET["a"];
      \$this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId({$nomeClasse} \${$nomeTabela}){}
    function buscaTodos(){}

}
new {$nomeClasse}Control();
?>
EOT;
            file_put_contents("sistema/control/{$nomeTabela}Control.php", $conteudo);
        }
    }

    function criaEstilo()
    {
        $estilosViews = <<<EOT
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: flex-start;
    justify-content: center;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-width: 400px;
    margin-top: 40px;
}

form {
    background-color: white;
    padding: 24px 18px;
    border-radius: 12px;
    box-shadow: 0 0 12px rgba(0,0,0,0.08);
    width: 100%;
    max-width: 370px;
    margin:auto 24px auto;
}

h1 {
    text-align: center;
    margin-bottom: 12px;
    color: #333;
    font-size: 1.5rem;
}

label {
    display: block;
    margin-bottom: 5px;
    margin-top: 14px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="password"],
input[type="number"],
input[type="date"],
input[type="time"],
select {
    width: 100%;
    padding: 9px;
    margin-bottom: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    box-sizing: border-box;
    background-color: #fafafa;
    transition: border-color 0.2s;
}

input:focus,
select:focus {
    border-color: #4CAF50;
    outline: none;
}

button {
    margin-top: 18px;
    width: 100%;
    padding: 11px;
    background-color: #4CAF50;
    border: none;
    color: white;
    font-size: 1.08rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.2s;
}

button:hover {
    background-color: #45a049;
}

@media (max-width: 500px) {
    form {
        max-width: 98vw;
        width: 98vw;
        padding: 18px 4vw;
    }
}
EOT;
        file_put_contents("sistema/styles/views.css", $estilosViews);
    }
    function compactar()
    {
        $folderToZip = 'sistema';
        $outputZip = 'sistema.zip';
        $zip = new ZipArchive();
        if ($zip->open($outputZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            header("Location:index.php?msg=6");
            exit;
        }
        $folderPath = realpath($folderToZip);
        if (!is_dir($folderPath)) {
            header("Location:index.php?msg=0&info=" . urlencode("Diretório 'sistema' não encontrado."));
            exit;
        }
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderPath) + 1);
                if (!$zip->addFile($filePath, $relativePath)) {
                    header("Location:index.php?msg=0&info=" . urlencode("Erro ao adicionar arquivo: $relativePath"));
                    exit;
                }
            }
        }

        if (!$zip->close()) {
            header("Location:index.php?msg=5");
            exit;
        }
        return true;
    }
}

new Creator();
