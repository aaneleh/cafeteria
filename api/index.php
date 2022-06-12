<?php
    session_start();
    
    $jsonPedidos = file_get_contents("../pedidos.json");
    $jsonProdutos = file_get_contents("../produtos.json");
    $dadosPedidos = json_decode($jsonPedidos, true);
    $dadosProdutos = json_decode($jsonProdutos, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../style/admin.css">
    <link rel="stylesheet" href="../style/base.css">
    <title>Admin</title>
</head>
<body>
    <nav class="nav">
        <div class="nav-container">
            <h1 class="logo"> Dostoievski </h1>
        </div>
    </nav>

    <main>
        <?php   
            //verifica se o usuario já logou
            if(isset($_SESSION['logon']) and $_SESSION['logon'] == 1){
                //se tem uma página carrega ela 
                if(isset($_GET['pag']) and !empty($_GET['pag'])){
                    $pag = $_GET['pag'];
                } else {
                    //se não vai pra pedidos por default
                    $pag = 'pedidos';
                }
            } else {
                //se o usuario não logou vai pra pagina de login
                $pag = 'login';
            }
            require_once($pag.'.php');
        ?>
    </main>

    <footer class="rodape">
        <div class="rodape-container">
            <a href="index.php?pag=pedidos">Pedidos</a>
            <a href="index.php?pag=produtos">Produtos</a>
            <a href="index.php?pag=adicionar">Novo Produto</a>
        </div>
        <div class="rodape-admin">
            <a href="GET.PHP?action=sair">Sair</a>
        </div>
    </footer>
</body>
</html>