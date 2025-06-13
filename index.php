<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Formulário de Conexão</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <form action="creator.php" method="POST">

        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_erros', 1);
        error_reporting(E_ALL);
        //sempre coloco isso para mostrar os erros
        include "erros.php";
        if (isset($_GET['msg'])) //quando a variavel for 0, ela é lida como false;
        {
            echo "<div id='mensagem'>" . ($mensagens[$_GET['msg']] ?? "Erro desconhecido") . "</div>";
            if ($_GET['info']) { //para saber mais sobre o erro caso tver descrição
                echo "<div id='info'>" . $_GET['info'] . "</div>";
            }
        }
        ?>

        <h1>EasyMVC</h1>
        <h2>Configuração</h2>
        <label for="servidor">Servidor:</label>
        <input type="text" id="servidor" name="servidor" required>

        <label for="banco">Banco de Dados:</label>
        <input type="text" id="banco" name="banco" required>

        <label for="porta">Porta:</label>
        <input type="number" id="porta" name="porta" required> 

        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required> 

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha">

        <button type="submit">Enviar</button>
    </form>

</body>

</html>