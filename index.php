<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Formulário de Conexão</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
<<<<<<< HEAD
<<<<<<< HEAD
    <div class="container">
        <form action="creator.php" method="POST">

            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_erros', 1);
            error_reporting(E_ALL);
            //sempre coloco isso para mostrar os erros
            include "mensagem.php";
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
    </div>

=======
=======
>>>>>>> 271eb9667fc27c6d1df654e2c0826af9fd13fab6
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
<<<<<<< HEAD
>>>>>>> 271eb9667fc27c6d1df654e2c0826af9fd13fab6
=======
>>>>>>> 271eb9667fc27c6d1df654e2c0826af9fd13fab6

</body>

</html>