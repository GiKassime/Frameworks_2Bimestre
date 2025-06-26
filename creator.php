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
    private $senha;
    private $tabelas;
    private $porta;
    private $atributos;


    function __construct()
    {
        $this->servidor = $_POST["servidor"];
        $this->banco = $_POST["banco"];
        $this->usuario = $_POST["usuario"];
        $this->senha = $_POST["senha"];
        $this->porta = $_POST["porta"];
        $this->criaDiretorios();
        $this->conectar();
        $this->buscaTabelas();
        $this->ClassesModel();
        $this->ClasseConexao();
        $this->ClassesControl();
        $this->classesView();
        if (!$this->compactar()) {
            header("Location:index.php?msg=3");
        } 
        header("Location:index.php?msg=4");
        
    }

    function criaDiretorios()
    {
        $dirs = ["sistema", "sistema/model", "sistema/control", "sistema/view", "sistema/dao"];

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
            header("Location:index.php?msg=1&info=" . $e->getMessage());
        }
    }

    function buscaTabelas()
    {
        try {
            $sql = "SHOW TABLES";
            $query = $this->con->query($sql);
            $this->tabelas = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            header("Location:index.php?msg=2&info=" . $e->getMessage());
        }
    }

    function buscaAtributos($nomeTabela)
    {
        try {
            $sql = "show columns from " . $nomeTabela;
            $atributos = $this->con->query($sql)->fetchAll(PDO::FETCH_OBJ);
            return $atributos;
        } catch (Exception $e) {
            header("Location:index.php?msg=3&info=" . $e->getMessage());
        }
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
class {$nomeTabela} 
{
{$nomeAtributos}
{$geters_seters}
}
?>
EOT;
            file_put_contents("sistema/model/{$nomeTabela}.php", $conteudo);
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
    private \$porta;
    function __construct() {
        \$this->server = '[Informe aqui o servidor]';
        \$this->banco = '[Informe aqui o seu Banco de dados]';
        \$this->usuario = '[Informe aqui o usuário do banco de dados]';
        \$this->senha = '[Informe aqui a senha do banco de dados]';
        \$this->porta = '[Informe aqui a porta do banco de dados]';
    }
    function conectar() {
        try {
            \$conn = new PDO(
                "mysql:host=" . \$this->server . ";port=".\$this->porta.";dbname=" . \$this->banco,\$this->usuario,
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
            $nomeTabela = ucfirst(array_values((array) $tabela)[0]);
            $requires = "require_once '../model/{$nomeTabela}.php';\nrequire_once '../dao/{$nomeTabela}DAO.php';\n";
            $nomeAtributos = ["dao", "{$nomeTabela}", "acao"];
            $atributos = '';
            foreach ($nomeAtributos as $atributo) {
                $atributos .= "\tprivate \$" . lcfirst($atributo) . ";\n";
            }
            $nomesMetodos = ["__construct", "verificaAcao", "listar", "inserir", "alterar", "excluir", "buscarTodos", "buscarPorId"];
            $metodos = '';
            foreach ($nomesMetodos as $metodo) {
                $parametro = '';
                $corpo = '';
                if ($metodo == "buscarPorId") {
                    $parametro = "{$nomeTabela} \$" . lcfirst($nomeTabela);
                }
                if ($metodo == '__construct') {
                    $corpo = "\t\t\$this->".lcfirst($nomeTabela)." = new {$nomeTabela}();\n";
                    $corpo .= "\t\t\$this->dao = new {$nomeTabela}DAO();\n";
                    $corpo .= "\t\t\$this->verificaAcao();\n";
                    $corpo .= "\t\t\$this->acao=\$_GET['a'];\n";
                }
                $metodos .= "\tpublic function {$metodo}({$parametro}) {\n";
                $metodos .= "{$corpo}";
                $metodos .= "\t}\n";
            }
            $conteudo = <<<EOT
<?php
{$requires}
class {$nomeTabela}Control 
{
{$atributos}
{$metodos}
}
new {$nomeTabela}Control();
?>
EOT;
            file_put_contents("sistema/control/{$nomeTabela}Control.php", $conteudo);
        }
    }

    function compactar(){
        $folderToZip = 'sistema';
        $outputZip  = 'sistema.zip';
        $zip = new ZipArchive();
        if($zip->open($outputZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return false;
        }
        $folderPath = realpath($folderToZip);
        if(!is_dir($folderPath)) {
            return false;
        }
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
        } 
        return $zip->close();
    }
    function classesView(){
        foreach ($this->tabelas as $tabela) {
            $nomeTabela = array_values((array) $tabela)[0];
            $atributos= $this->buscaAtributos($nomeTabela);
            $formCampos = "";
            foreach ($atributos as $atributo) {
                $atributo = $atributo->Field;
                $formCampos .= "<label for='{$atributo}'>".ucfirst($atributo).":</label>\n";
                $formCampos .= "<input type='text' id='{$atributo}' name='{$atributo}'><br>\n";
            }
            $nomeTabela = ucfirst($nomeTabela);
            $conteudo = <<<EOT
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de {$nomeTabela}</title>
</head>
<body>
    <h1>Cadastro de {$nomeTabela}</h1>
    <form>
        {$formCampos}
    </form>
</body>
</html>
EOT;
            file_put_contents("sistema/view/{$nomeTabela}.php", $conteudo);
        }

    }
}

new Creator();
