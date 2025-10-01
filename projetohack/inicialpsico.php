<?php
    session_start();
    // Salvar avaliação enviada pelo modal
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST' && 
        isset($_POST['avaliacao']) && 
        isset($_POST['relatorio_id']) && 
        isset($_POST['classpsico'])
    ) {
        $avaliacoes = file_exists('avaliacao.json') ? json_decode(file_get_contents('avaliacao.json'), true) : [];
        if (!is_array($avaliacoes)) $avaliacoes = [];
        $id_relatorio = intval($_POST['relatorio_id']);
        $_SESSION['id'] = $id_relatorio;
        $id = array_search($_SESSION['usuario'], $emails);
        $psicologo_nome = isset($nomes[$id_relatorio]) ? $nomes[$id_relatorio] : 'Desconhecido';
        $nivel_urgencia = $_POST['classpsico'];
        $jaAvaliou = false;
        foreach ($avaliacoes as $idx => $av) {
            if ($av['relatorio_id'] == $id_relatorio && $av['psicologo'] == $psicologo_nome) {
                // Se for edição, atualiza
                $avaliacoes[$idx]['avaliacao'] = $_POST['avaliacao'];
                $avaliacoes[$idx]['classpsico'] = $nivel_urgencia;
                $avaliacoes[$idx]['data'] = date('Y-m-d H:i:s');
                $jaAvaliou = true;
                break;
            }
        }
        if (!$jaAvaliou) {
            $avaliacao = [
                'relatorio_id' => $id_relatorio,
                'avaliacao' => $_POST['avaliacao'],
                'classpsico' => $nivel_urgencia,
                'psicologo' => $psicologo_nome,
                'data' => date('Y-m-d H:i:s')
            ];
            $avaliacoes[] = $avaliacao;
        }
        file_put_contents('avaliacao.json', json_encode($avaliacoes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo '<script>alert("Avaliação salva com sucesso!");</script>';
    }
    if(!isset($_SESSION['usuario'])){
        header('Location:index.php');
    }
    if(!isset($_SESSION['nomes'])){
        $emails = json_decode(file_get_contents("email.json"), true);
        $senhas = json_decode(file_get_contents("senha.json"), true);
        $nomes = json_decode(file_get_contents("nome.json"), true);
        $relatorios = json_decode(file_get_contents("relatorio.json"), true);
        $classes = json_decode(file_get_contents("class.json"), true);
        $id = array_search($_SESSION['usuario'], $emails);
        $_SESSION['nomes'] = $nomes;
        $_SESSION['senhas'] = $senhas;
        $_SESSION['emails'] = $emails;
        $_SESSION['relatorios'] = $relatorios;
        $_SESSION['classes'] = $classes;
    }
    else{
        $emails = $_SESSION['emails'];
        $id = array_search($_SESSION['usuario'], $emails);
        $nomes = $_SESSION['nomes'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <meta http-equiv="content-language" content="pt-br">
        <title>PROJETO</title>
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
    </style>
    <body>
        <div class="card-body" style="background-color: #D3D3D3">    
            <center><h2><b>PROJETO</b></h2></center>
        </div>
        <br/><br/>
        <nav>
            <?php
                // Redirecionamento dinâmico do HOME
                $homeLink = 'inicial.php';
                if (isset($nomes[$id])) {
                    if (stripos($nomes[$id], 'psicologo') !== false) {
                        $homeLink = 'inicialpsico.php';
                    } elseif (stripos($nomes[$id], 'professor') !== false) {
                        $homeLink = 'inicialprof.php';
                    }
                }
            ?>
            &nbsp;&nbsp;<b><a href="<?php echo $homeLink; ?>" style="color: white; text-decoration:none"> HOME |</a><a href="gravar.php" style="color: white; text-decoration:none"> SALVAR DADOS</a></b>
            <div class="user" style="color: white; text-decoration:none">
                <b><a href="sair.php" style="color: white; text-decoration:none">SAIR</a></b>&nbsp;&nbsp;
            </div>
        </nav>
        <br/><br/>
        <br/>
        <center>
            <a href="listagem.php">
                <button class="button" data-text="Awesome" type="button">
                    <span class="actual-text">&nbsp;AVALIAR RELATÓRIOS&nbsp;</span>
                </button>
            </a>
        </center>
        <br/>
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
    </body>
</html>