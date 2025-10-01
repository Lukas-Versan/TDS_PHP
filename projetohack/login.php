<?php
    session_start();
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $nomes = json_decode(file_get_contents("nome.json"), true);
    $emails = json_decode(file_get_contents("email.json"), true);
    $senhas = json_decode(file_get_contents("senha.json"), true);
    $indice = array_search($email, $emails);
    if ($indice !== false && isset($senhas[$indice]) && $senha === $senhas [$indice]){
        if($email === "professor@teste.com"){
            $_SESSION['usuario'] = $email;
            header("Location: inicialprof.php");
            exit;
        }else if($email === "psicologo@teste.com"){
            $_SESSION['usuario'] = $email;
            header("Location: inicialpsico.php");
            exit;
        }
    else{
        echo "<script>alert ('Credenciais inválidas. Tente novamente, por favor!');</script>";
        echo "<script>window.location.href='index.php'; </script>";
        exit;
        }
    }
?>  
