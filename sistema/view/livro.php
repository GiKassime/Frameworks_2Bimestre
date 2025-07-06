<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de livro</title>
    <link rel="stylesheet" href="./../styles/views.css">
</head>
<body>
    <form> 
        <h1>Cadastro de livro</h1>
        <label for='campo_id'>id</label>
<input type='number' name='campo_id' id='campo_id'><br>
<label for='campo_titulo'>titulo</label>
<input type='text' name='campo_titulo' id='campo_titulo'><br>
<label for='campo_ano_publicacao'>ano_publicacao</label>
<input type='text' name='campo_ano_publicacao' id='campo_ano_publicacao'><br>
<label for='campo_id_autor'>id_autor</label>
<input type='number' name='campo_id_autor' id='campo_id_autor'><br>
<label for='campo_id_categoria'>id_categoria</label>
<input type='number' name='campo_id_categoria' id='campo_id_categoria'><br>
<label for='campo_preco'>preco</label>
<input type='number' name='campo_preco' id='campo_preco' step='any'><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>