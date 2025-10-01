<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location:index.php');
    }
    if(!isset($_SESSION['nomes'])){
        $emails = json_decode(file_get_contents("email.json"), true);
        $senhas = json_decode(file_get_contents("senha.json"), true);
        $nomes = json_decode(file_get_contents("nome.json"), true);
        $generos = json_decode(file_get_contents("genero.json"), true);
        $id = array_search($_SESSION['usuario'], $emails);
        $_SESSION['nomes'] = $nomes;
        $_SESSION['senhas'] = $senhas;
        $_SESSION['generos'] = $generos;
        $_SESSION['emails'] = $emails;
    }
    else{
        $emails = $_SESSION['emails'];
        $id = array_search($_SESSION['usuario'], $emails);
        $nomes = $_SESSION['nomes'];
    }
    $data = date('d/m/Y');
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
        .cols{
            height: 100%;
            width: 30%;
        }
        /* From Uiverse.io by satyamchaudharydev */ 
        /* === removing default button style ===*/
            /* From Uiverse.io by adamgiebl */ 
        button {
        font-size: 18px;
        letter-spacing: 2px;
        text-transform: uppercase;
        display: inline-block;
        text-align: center;
        font-weight: bold;
        padding: 0.7em 2em;
        border: 3px solid #FF0072;
        border-radius: 2px;
        position: relative;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.1);
        color: #FF0072;
        text-decoration: none;
        transition: 0.3s ease all;
        z-index: 1;
        }

        button:before {
        transition: 0.5s all ease;
        position: absolute;
        top: 0;
        left: 50%;
        right: 50%;
        bottom: 0;
        opacity: 0;
        content: '';
        background-color: #FF0072;
        z-index: -1;
        }

        button:hover, button:focus {
        color: white;
        }

        button:hover:before, button:focus:before {
        transition: 0.5s all ease;
        left: 0;
        right: 0;
        opacity: 1;
        }

        button:active {
        transform: scale(0.9);
        }
    </style>
    <body>
        <div class="card-body" style="background-color: #D3D3D3">    
            <center><h2><b>PHP/ARRAY</b></h2></center>
        </div>
        <br/><br/>
        <nav>
            &nbsp;&nbsp;<b><a href="inicial.php" style="color: white; text-decoration:none"> HOME |</a><a href="gravar.php" style="color: white; text-decoration:none"> SALVAR DADOS</a></b>
            <div class="user" style="color: white; text-decoration:none">
                <b><a href="sair.php" style="color: white; text-decoration:none">SAIR</a></b>&nbsp;&nbsp;
            </div>
        </nav>
        <br/><br/>
        <center>
            <button class="button" data-text="Awesome" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="actual-text">&nbsp;RELATÓRIO&nbsp;</span>
            </button>
        </center>
        <br/><br/>
        <div class="row justify-content-center row-cols-2 row-cols-md-3 text-center">
            <div class="cols">
                <div class="card mb-4 rounded shadow-sw">
                    <div class="card-header py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#000080" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                    </svg><br/>
                        <h3><font color="black"><b>USUÁRIOS</b></font></h3>
                    </div>
                    <div class="card-body">
                        <?php
                            include "usuarios.php";
                        ?>
                    </div>
                </div>
            </div>
            <div class="cols">
                <div class="card mb-4 rounded shadow-sw">
                    <div class="card-header py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#000080" class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
                    <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/>
                    </svg><h3><font color="black"><b>GÊNEROS</b></font></h3>
                    </div>
                    <center><div class="card-body">
                        <?php
                            include "generos.php";
                        ?>
                    </div></center>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">RELATÓRIO - <?php echo $data; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <form action="cadastro.php" method="post">
                            <label class="form-label">RELATÓRIO</label>
                            <textarea class="form-control" name="relatorio" required placeholder="Digite aqui" rows="6" style="resize:vertical;"></textarea>
                            </br>
                            <label class="form-label">CLASSIFICAÇÃO</label>
                            <select class="form-select" aria-label="Selecione seu gênero" name="classificacao" required>
                                <option selected>Selecione o nível de urgência do caso</option>
                                <option value="A">Alta</option>
                                <option value="B">Média</option>
                                <option value="C">Baixa</option>
                            </select>
                            </br>
                            <input type="submit" class="btn btn-success" value="ENVIAR">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>