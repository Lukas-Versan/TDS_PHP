<?php
    session_start();
    //Inicializa o array
    if(!isset($_SESSION['pessoas'])){
        $_SESSION['pessoas'] = [];
    }
    //Adicionar
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        $id = $_POST['id'];
        $pessoa = ['nome'=>$nome, 'idade'=>$idade];
        if($id === ''){
            $_SESSION['pessoas'][] = $pessoa; //Criando o registro
        }
        else{
            $_SESSION['pessoas'][$id] = $pessoa;//Atualizando
        }
        header("Location:pessoa.php");
        exit();
    }
    //Deletar
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        unset($_SESSION['pessoas'][$id]);
        header("Location:pessoa.php");
        exit();
    }
    //Editar
    $editando = false;
    $editId = '';
    $editNome = '';
    $editIdade = '';
    if(isset($_GET['edit'])){
        $editando = true;
        $editId = $_GET['edit'];
        $editNome = $_SESSION['pessoas'][$editId]['nome'];
        $editIdade = $_SESSION['pessoas'][$editId]['idade'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>CRUD</title>
        <style>
            body{
                background-color: #E0FFFF;
            }
        </style>
    </head>
    <body>
        <div class="background-color">
    <center><h2>CRUD</h2></center>
        <hr/>
        <div class="row justify-content-center row-cols-1 row-cols-md-2 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sw">
                    <div class="card-header py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="green" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                    </svg>&nbsp;&nbsp;<font style="font-size: 30px;"><b>CRUD PESSOA</b></font>
                    </div><br/>
        <h2><?=$editando ? "Editar pessoa" : "Cadastrar pessoa"?></h2>
        <form method="post" action="pessoa.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($editId)?>">
            <label>NOME</label><br/>
            <input type="text" name="nome" required value="<?=htmlspecialchars($editNome)?>"><br/><br/>
            <label>IDADE</label><br/>
            <input type="number" name="idade" required value="<?htmlspecialchars($editIdade)?>"><br/><br/>
            <button type="submit" class="btn btn-outline-success"><?=$editando ? "Atualizar": "Cadastrar"?></button><br/><br/>
        </form>
        <h2>LISTA DAS PESSOAS</h2><br/>
        <table border="1" cellpadding="5" class="table table-striped">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>IDADE</th>
                <th>AÇÕES</th>
            </tr>
            <?php foreach($_SESSION['pessoas'] as $index => $pessoa): ?>
                <tr>
                    <td><?=$index ?></td>
                    <td><?= htmlspecialchars($pessoa['nome'])?></td>
                    <td><?= htmlspecialchars($pessoa['idade'])?></td>
                    <td>
                        <a href="pessoa.php?edit=<?=$index?>">Editar</a>  |
                        <a href="pessoa.php?delete=<?=$index?>" onclick="return confirm('Deseja realmente excluir')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach ?>  
        </table>
    </body>
</html>