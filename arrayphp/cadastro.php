<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $genero = $_POST['genero'];
        array_push($_SESSION['nomes'], $nome);
        array_push($_SESSION['emails'], $email);
        array_push($_SESSION['senhas'], $senha);
        array_push($_SESSION['generos'], $genero);
        header("location: inicial.php");
    }

?>