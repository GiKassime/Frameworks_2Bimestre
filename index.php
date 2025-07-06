<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Formulário de Conexão</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>



    <div class="container">
        <div class="mensagens">
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_erros', 1);
        error_reporting(E_ALL);
        //sempre coloco isso para mostrar os erros
        include "mensagem.php";
        require_once "models/Conexao.php";
        if (isset($_GET['msg'])) //quando a variavel for 0, ela é lida como false;
        {
            $classe = $_GET['msg'] == 4 ? "mensagem" : "mensagem_erro";
            echo "<div class='{$classe}'>" . ($mensagens[$_GET['msg']] ?? "Erro desconhecido") . "</div>";
            if (isset($_GET['info'])) { //para saber mais sobre o erro caso tver descrição
                echo "<div class='mensagem_info'>" . $_GET['info'] . "</div>";
            }
        }
        ?>
    </div>
        <form action="index.php" method="POST" class="<?= isset($_POST['servidor']) ? 'esconde' : 'mostra' ?>">
            <h1>EasyMVC</h1>
            <h2>Configuração</h2>
            <label for="servidor">Servidor:</label>
            <input type="text" id="servidor" name="servidor" value="<?= isset($_POST['servidor']) ? $_POST['servidor']  : null ?>" required>

            <label for="porta">Porta:</label>
            <input type="number" id="porta" name="porta" value="<?= isset($_POST['porta']) ? $_POST['porta']  : null ?>" required>

            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" value="<?= isset($_POST['usuario']) ? $_POST['usuario']  : null ?>" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?= isset($_POST['senha']) ? $_POST['senha']  : null ?>">

            <button type="submit">Enviar</button>
        </form>
        <?php

        if (isset($_POST['servidor']) && isset($_POST['porta']) && isset($_POST['usuario']) && isset($_POST['senha'])) {
            try {
                $sql = "SHOW DATABASES;";
                $conexao = new Conexao($_POST['servidor'], $_POST['porta'], $_POST['usuario'], $_POST['senha']);
                $conexao = $conexao->conectarDb();
                $query = $conexao->query($sql);
                $bancos = $query->fetchAll(PDO::FETCH_ASSOC);
                echo "<form action='creator.php' method='POST'>";
                echo "<input type='hidden' name='servidor' value='" . htmlspecialchars($_POST['servidor']) . "'>";
                echo "<input type='hidden' name='porta' value='" . htmlspecialchars($_POST['porta']) . "'>";
                echo "<input type='hidden' name='usuario' value='" . htmlspecialchars($_POST['usuario']) . "'>"; //fiz assim pra kle enviar o post desses dnv pro creator
                echo "<input type='hidden' name='senha' value='" . htmlspecialchars($_POST['senha']) . "'>";
                echo "<label>Selecione a Database</label>\n<select name='banco' id='banco'>";
                foreach ($bancos as $key => $banco) {
                    $nomeBanco = array_values((array) $banco)[0];
                    echo "<option value='{$nomeBanco}'>{$nomeBanco}</option>";
                }
                echo "</select>\n<button type='submit'>Enviar</button>\n</form>";
            } catch (Exception $e) {
                header("Location:index.php?msjg=1&info=" . urlencode($e->getMessage()));
            }
        }
        ?>
    </div>
</body>

</html>