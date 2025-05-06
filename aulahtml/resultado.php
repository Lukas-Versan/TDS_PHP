<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['palavra'])) {
        $_SESSION['palavra'] = strtolower(trim($_POST['palavra']));
        $_SESSION['tentativas'] = 3;
    }
    $jogoencerrado = false;
    if (!isset($_SESSION['palavra'])) {
        header("Location:index.php");
        exit;
    }
    $palavra = $_SESSION['palavra'];
    $tamanho = strlen($palavra);
    $msg = '';
    if (isset($_POST['chute'])) {
        $chute = strtolower(trim($_POST['chute']));
        $_SESSION['tentativas']--;
        if ($chute === $palavra) {
            $msg = "<div class='alert alert-success'>Parabéns! Você acertou a palavra: <strong>$palavra</strong></div>";
            $jogoencerrado = true;
        } elseif ($_SESSION['tentativas'] <= 0) {
            $msg = "<div class='alert alert-danger'>Você perdeu! A palavra era: <strong>$palavra</strong></div>";
            $jogoencerrado = true;
        } else {
            $msg = "<div class='alert alert-warning'>Errado! Tentativas restantes: <strong>{$_SESSION['tentativas']}</strong></div>";
        }
        if ($jogoencerrado) {
            session_unset();
            session_destroy();
            header("Refresh: 5;URL=index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Palavra Secreta</title>
    </head>
    <body>
        <center><h2>GAME WORD</h2></center>
        <hr/>
        <div class="row justify-content-center row-cols-1 row-cols-md-2 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sw">
                    <div class="card-header py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247m2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                    </svg>&nbsp;&nbsp;<font style="font-size: 30px;"><b>PALAVRA SECRETA</b></font>
                    </div>
                    <div class="card-body">
                        <h3>Dica: A palavra tem <strong><?php echo $tamanho; ?> letras.</strong></h3>
                        <?php if(!empty($msg)) echo $msg; ?>
                        <?php if(!$jogoencerrado): ?>
                        <form action="resultado.php" method="post">
                            <label class="form-label">Digite uma palavra</label>
                            <input class="form-control" type="text" name="chute" required placeholder="Digite uma palavra"/>
                            <br/>
                            <input type="submit" class="btn btn-outline-success" value="INICIAR O JOGO"/>
                        </form>
                        <?php else: ?>
                            <a href="index.php" class="btn btn-secondary">RECOMEÇAR</a>
                            <p class="text-muted mt-2">Você será redirecionado em alguns segundos...</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
