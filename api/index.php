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
            session_start();
            if(isset($_SESSION['user'])){
                //se tem uma página carrega ela 
                if(isset($_GET['pag']) and !empty($_GET['pag']) and isset($_SESSION['user'])){
                    $pag = $_GET['pag'];
                    require_once($pag.'.php');
                //se não vai pra pedidos por default
                } else {
                    require_once('pedidos.php');
                }
            //se o usuario não logou vai pra pagina de login
            } else {
                require_once('login.php');
            }
        ?>
    </main>

    <footer class="rodape">
        <div class="rodape-container">
            <a href="index.php?pag=pedidos">Pedidos</a>
            <a href="index.php?pag=produtos">Produtos</a>
            <a href="index.php?pag=adicionar">Novo Produto</a>
        </div>
        <div class="rodape-admin">
            <a href="sair.php">Sair</a>
        </div>
    </footer>
</body>
</html>