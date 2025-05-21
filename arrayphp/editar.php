<?php
    session_start();
    if (isset($_GET['pos'])) {
        $index = $_GET['pos'];
        if (isset($_SESSION['nomes'][$index]) && isset($_SESSION['emails'][$index]) && isset($_SESSION['generos'][$index]) && isset($_SESSION['senhas'][$index])) {
            $nome = $_SESSION['nomes'][$index];
            $email = $_SESSION['emails'][$index];
            $genero = $_SESSION['generos'][$index];
            $senha = $_SESSION['senhas'][$index]; 
        } else {
            header("Location: listagem.php");
            exit;
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $index = $_POST['index']; 
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $genero = $_POST['genero'];
        foreach ($_SESSION['emails'] as $key => $existingEmail) {
            if ($existingEmail === $email && $key != $index) {
                echo "<script language='javascript'type='text/javascript'>
                alert('E-mail já cadastrado para outro usuário!');
                window.location.href='listagem.php';
                </script>";
                exit;
            }
        }
        $_SESSION['nomes'][$index] = $nome;
        $_SESSION['emails'][$index] = $email;
        $_SESSION['senhas'][$index] = $senha;
        $_SESSION['generos'][$index] = $genero;
        header("Location: listagem.php");
        exit;
    } else {
        header("Location: listagem.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">        
    <head>
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <meta http-equiv="content-language" content="pt-br">
        <title>PHP / Array</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <style>
        .user{
            float: right;
        }
        body{
            background: linear-gradient(-45deg, #696969, #4F4F4F, #363636, #1C1C1C);
            background-size: 400% 400%;
            animation: gradient 18s ease infinite;
        }
        .modal-dialog{
            max-width: 500px;
        }


        @keyframes gradient {
            0% {
            background-position: 0 50%;
            }
            50% {
            background-position: 100% 50%;
            }
            100% {
            background-position: 0% 50%;
        }
    }
    </style>
     <script>
        var myModal = new bootstrap.Modal(document.getElementById('editUserModal'), {
            backdrop: 'static', 
            keyboard: false 
        });
        myModal.show();
    </script>
    <body>
        <div class="card-body" style="background-color: #D3D3D3">    
        </div>
        <div class="modal fade show" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDITAR USUÁRIO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <form action="listagem.php" method="post">
                            <label class="form-label">NOME</label>
                            <input class="form-control" type="text" name="nome" value="<?php echo $nome?>">
                            </br>
                            <label class="form-label">GÊNERO</label>
                            <select class="form-select" aria-label="Selecione seu gênero" name="genero" required>
                                <option selected><?php echo $genero ?></option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Outro">Outro</option>
                            </select>
                            </br>
                            <label class="form-label">E-MAIL</label>
                            <input class="form-control" type="email" name="email" value="<?php echo $email ?>">
                            </br>
                            <label class="form-label">SENHA</label>
                            <input class="form-control" type="password" name="senha" value="<?php echo $senha ?>">
                            </br>
                            <input type="submit" class="btn btn-success" value="EDITAR">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
                    </div>
                </div>
            </div>
        </div>
         <script>
    </script>
    </body>
</html>