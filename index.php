<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Formulário de Conexão</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <form action="index.php?mostrar=1" method="POST">

            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_erros', 1);
            error_reporting(E_ALL);
            //sempre coloco isso para mostrar os erros
            include "mensagem.php";
            require_once "models/Conexao.php";
            if (isset($_GET['msg'])) //quando a variavel for 0, ela é lida como false;
            {
                $classe = $_GET['msg'] == 3 ? "mensagem_erro" : "mensagem";
                echo "<div class='{$classe}'>" . ($mensagens[$_GET['msg']] ?? "Erro desconhecido") . "</div>";
                if (isset($_GET['info'])) { //para saber mais sobre o erro caso tver descrição
                    echo "<div class='mensagem'>" . $_GET['info'] . "</div>";
                }
            }
            ?>

            <h1>EasyMVC</h1>
            <h2>Configuração</h2>
            <label for="servidor">Servidor:</label>
            <input type="text" id="servidor" name="servidor"  value="<?= isset($_POST['servidor']) ? $_POST['servidor']  : null ?>" required>

            <label for="porta">Porta:</label>
            <input type="number" id="porta" name="porta"   value="<?= isset($_POST['porta']) ? $_POST['porta']  : null ?>"required>

            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" value="<?= isset($_POST['usuario']) ? $_POST['usuario']  : null ?>" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha"  value="<?= isset($_POST['senha']) ? $_POST['senha']  : null ?>">

            <?php 

            if (isset($_GET['mostrar']) && $_GET['mostrar'] == 1) {
                $conexao = new Conexao($_POST['servidor'], $_POST['porta'], $_POST['usuario'], $_POST['senha']);
                try {
                    $sql = "SHOW DATABASES";
                    $conn = $conexao->conectar();
                    $stmt = $conn->prepare($sql);
                    $query = $conexao->query($sql);
                    $bancos= $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                    header("Location:index.php?msg=1&info=" . urlencode($e->getMessage()));
                }
                echo "<select name='banco' id='banco'>";
                foreach ($bancos as $key => $banco) {
                    $nomeBanco = array_values((array) $banco)[0];
                    echo "<option value='{$nomeBanco}'>{$nomeBanco}</option>";
                }
                echo "</select>";

            }
                
            ?>

            <button type="submit" onsubmit="carregarDB()">Enviar</button>
        </form>
    </div>
    <script>
        function carregarDB(){
            
        }
    </script>
</body>

</html>