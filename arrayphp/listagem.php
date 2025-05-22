<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location:index.php');
    }
    $emails = $_SESSION['emails'];
    $id = array_search($_SESSION['usuario'], $emails);
    $nomes = $_SESSION['nomes'];

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
        .cols1{
            width:300px
        }
        /* From Uiverse.io by LightAndy1 */ 
        .group {
        display: flex;
        line-height: 28px;
        align-items: center;
        position: relative;
        max-width: 190px;
        }

        .input {
        font-family: "Montserrat", sans-serif;
        width: 100%;
        height: 45px;
        padding-left: 2.5rem;
        box-shadow: 0 0 0 1.5px #2b2c37, 0 0 25px -17px #000;
        border: 0;
        border-radius: 12px;
        background-color: #16171d;
        outline: none;
        color: #bdbecb;
        transition: all 0.25s cubic-bezier(0.19, 1, 0.22, 1);
        cursor: text;
        z-index: 0;
        }

        .input::placeholder {
        color: white;
        }

        .input:hover {
        box-shadow: 0 0 0 2.5px darkblue, 0px 0px 25px -15px #000;
        }

        .input:active {
        transform: scale(0.95);
        }

        .input:focus {
        box-shadow: 0 0 0 2.5px #2f303d;
        }

        .search-icon {
        position: absolute;
        left: 1rem;
        fill: #bdbecb;
        width: 1rem;
        height: 1rem;
        pointer-events: none;
        z-index: 1;
        }

    </style>
    <body>
        <div class="card-body" style="background-color: #D3D3D3">    
            <center><h2><b>PHP/ARRAY</b></h2></center>
        </div>
        <br/><br/>
        <nav>
            &nbsp;&nbsp;<b><a href="inicial.php" style="color: white; text-decoration:none"> HOME |</a><a href="listagem.php" style="color: white; text-decoration:none"> LISTAGEM |</a><a href="gravar.php" style="color: white; text-decoration:none"> SALVAR DADOS</a></b>
            <div class="user" style="color: white; text-decoration:none">
                <b><?php echo $nomes[$id]; ?> - <a href="sair.php" style="color: white; text-decoration:none">SAIR</a></b>&nbsp;&nbsp;
            </div>
        </nav>
        <br/><br/>
        <center>
        <div class="row justify-content-center row-cols-1 row-cols-md-3 text-center">
            <div class="cols1">
                <input class="pesquisa-nomes" type="text">
            </div>
        </div>
        <script>
            let inputElement = document.querySelector("input")
            let listElement = document.querySelector("<?php $nomes ?>")
            let itemElement = listElement.querySelectorAll("l<?php $nomes[$i] ?>")

            inputElement.addEventListener("input", (e) => {
            let inputed = e.target.value.toLowerCase()
            itemElement.forEach((nomes) => {
                let text = li.textContent.toLowerCase()
                if(text.includes(inputed)){
                li.style.display = "block"
                }else{
                li.style.display = "none"
                }
                i++;
            })
            })
        </script>

        </center>
        <br/><br/>
        <div class="row justify-content-center row-cols-1 row-cols-md-3 text-center">
            <div class="cols">
                <div class="card mb-4 rounded shadow-sw">
                    <div class="card-header py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#000080" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                    </svg><br/>
                        <h3><font color="black"><b>LISTAGEM DE USUÁRIOS</b></font></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>EMAIL</th>
                                <th>GÊNERO</th>
                                <th>AÇÕES</th>
                            </tr>
                            <?php $reg = count($_SESSION['nomes']);
                                for ($i=0; $i <= $reg-1; $i++){
                                    echo "<tr>";
                                        echo "<td>$i</td>";
                                        echo "<td>".$_SESSION['nomes'][$i]."</td>";
                                        echo "<td>".$_SESSION['emails'][$i]."</td>";
                                        echo "<td>".$_SESSION['generos'][$i]."</td>";
                                        echo "<td><a href='editar.php?pos=$i' class='editar-btn' data-bs-toggle='modal' data-bs-target='#exampleModal' data-id='$i' data-nome='".$_SESSION['nomes'][$i]."' data-email='".$_SESSION['emails'][$i]."' data-genero='".$_SESSION['generos'][$i]."' data-senha='".$_SESSION['senhas'][$i]."'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                                        </svg></a> | <a href='excluir.php?pos=$i'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='red' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                        </svg></a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>ATUALIZAR USUÁRIO</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='editar.php' method='post'>
                            <label class='form-label'>NOME</label>
                            <input class='form-control' type='text' name='nome' id='edit-nome' required/>
                            <br/>
                            <label class='form-label'>E-MAIL</label>
                            <input class='form-control' type='email' name='email' id='edit-email' required/>
                            <br/>
                            <label class='form-label'>GENERO</label>
                            <select class='form-select' aria-label='Selecione um genero' name='genero' id='edit-genero' required>
                                <option selected>Selecione um genero</option>
                                <option value='Masculino'>Masculino</option>
                                <option value='Feminino'>Feminino</option>
                                <option value='Outro'>Outro</option>
                            </select>
                            <br/>
                            <label class='form-label'>SENHA</label>
                            <input class='form-control' type='password' id='edit-senha' name='senha'/>
                            <br/>
                            <input type='hidden' name='id' id='edit-id'/>
                            <input type='submit' class='btn btn-success' value='ATUALIZAR'/>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>FECHAR</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const botoesEditar = document.querySelectorAll('.editar-btn');
            botoesEditar.forEach(function(botao) {
            botao.addEventListener('click', function () {
                // Pega os valores do botão clicado
            const id = this.getAttribute('data-id');
            const nome = this.getAttribute('data-nome');
            const email = this.getAttribute('data-email');
            const genero = this.getAttribute('data-genero');
            const senha = this.getAttribute('data-senha');
                // Preenche os campos do modal
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nome').value = nome;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-genero').value = genero;
            document.getElementById('edit-senha').value = senha;
            });
            });
            });
        </script>        
    </body>
</html>