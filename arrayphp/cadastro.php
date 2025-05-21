<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $genero = $_POST['genero'];
        if(in_array($email, $_SESSION['emails'])){
            echo "<script language='javascript' type='text/javascript'>
            alert('E-mail já consta em nossa base de dados!')
            window.location.href='listagem.php'
            </script>";
            exit;
        }
        array_push($_SESSION['nomes'], $nome);
        array_push($_SESSION['emails'], $email);
        array_push($_SESSION['senhas'], $senha);
        array_push($_SESSION['generos'], $genero);
        header("location: inicial.php");
    }

?>