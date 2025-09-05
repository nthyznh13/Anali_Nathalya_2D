<?php
include "conexao.php";

if(isset($_POST['cadastra'])){
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $msg = mysqli_real_escape_string($conexao, $_POST['msg']);

    $sql = "INSERT INTO recado (nome, email, mensagem) VALUES ('$nome', '$email', '$msg')";
    mysqli_query($conexao, $sql) or die("Ero ao inserir dados: " . mysqli_error($conexao));
    header("Location: mural.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Mural de pedidos</title>
<link rel="stylesheet" href="style.css"/>

<script src="scripts/jquery.js"></script>
<script src="scripts/jquery.validate.js"></script>
<script>
$(document).ready(function() {
    $("#mural").validate({
        rules: {
            nome: { required: true, minlength: 4 },
            email: { required: true, email: true },
            msg: { required: true, minlength: 10 }
        },
        messages: {
            nome: { required: "Nathalya", minlength: "Naty" },
            email: { required: "nathybez13@gmail.com", email: "nathybez13@gmail.com" },
            msg: { required: "Oie, tudo bem?", minlength: "Eu vou para praia esse final de semana." }
        }
    });
});
</script>
</head>

<body>
<div id="main">
<div id="geral">
<div id="header">
    <h1>Mural de pedidos</h1>
</div>

<div id="formulario_mural">
<form id="mural" method="post">
    <label>Nome:</label>
    <input type="text" name="nome"/><br/>
    <label>Email:</label>
    <input type="text" name="email"/><br/>
    <label>Mensagem:</label>
    <textarea name="msg"></textarea><br/>
    <input type="submit" value="Publicar no Mural" name="cadastra" class="btn"/>
</form>
</div>

<?php
$seleciona = mysqli_query($conexao, "SELECT * FROM recado ORDER BY id DESC");
while($res = mysqli_fetch_assoc($seleciona)){
    echo '<ul class="recado">';
    echo '<li><strong>ID:</strong> ' . $res['id'] . '</li>';
    echo '<li><strong>Nome:</strong> ' . htmlspecialchars($res['nome']) . '</li>';
    echo '<li><strong>Email:</strong> ' . htmlspecialchars($res['email']) . '</li>';
    echo '<li><strong>Mensagem:</strong> ' . nl2br(htmlspecialchars($res['mensagem'])) . '</li>';
    echo '</ul>';
}
?>

<div id="footer">
</div>
</div>
</div>
</body>
<style>
body {
    background-image: url('https://i.pinimg.com/originals/0c/69/1c/0c691c22d44fa88809791e21069a502f.png');
    background-position: center center;
    background-size: cover;
    background-attachment: fixed;
    background-repeat: no-repeat;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #333;
}

.container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    padding: 30px;
    width: 100%;
    margin-bottom: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 25px;
    color: #2c3e50;
    font-size: 2em;
}

form {
    display: flex;
    flex-direction: column;
}


input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
    margin-bottom: 15px;
    resize: vertical;
}

button,
input[type="submit"] {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1.1em;
    transition: background-color 0.3s ease;
}

button:hover,
input[type="submit"]:hover {
    background-color: #2980b9;
}

.error-message {
    background-color: #fce7e7;
    color: #c0392b;
    padding: 15px;
    border: 2px solid #333;
    border-radius: 4px;
    font-size: 0.9em;
    text-align: center;
    box-shadow: 0 1px 5px rgba(192, 57, 43, 0.1);
}

@media (max-width: 768px) {
    body {
        padding: 10px;
    }
    .container {
        padding: 20px;
    }
    h1 {
        font-size: 1.5em;
    }
}
</style>
</html>