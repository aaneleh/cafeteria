<?php
    session_start();


    $jsonProdutos = file_get_contents("../produtos.json");
    $dadosProdutos = json_decode($jsonProdutos, true);

    $page = "";

    $action = $_POST['action'];

    switch ($action){
        case 'login':
            $page = 'login&status=wrongpass';
            if($_POST['pass'] == '1234') {//senha fixa
                $_SESSION['logon'] = true;
                $page = 'pedidos';
            }
            break;
        case 'adicionar':
            $page = "adicionar&status=invalid";
            if(isset($_SESSION['logon']) and $_SESSION['logon'] == 1){
                $novoProduto = new stdClass();

                if($_POST['nome'] != "" and $_POST['preco'] != "") {
                    $novoProduto->nome= $_POST['nome'];
                    //$novoProduto->arquivo = $_POST[''];
                    $_POST['descricao'] == "" ? $novoProduto->descricao = "sem descrição" : $novoProduto->descricao = $_POST['descricao'];
                    $novoProduto->preco = $_POST['preco'];
                    $novoProduto->categoria = $_POST['categoria'];

                    array_push($dadosProdutos, $novoProduto);
                    if(!file_put_contents("../produtos.json", json_encode($dadosProdutos, JSON_PRETTY_PRINT), LOCK_EX)){
                        echo("ERRO SALVANDO O ARQUIVO");
                    } else {
                        echo("SUCESSO");
                        $page = "produtos";
                    }
                }
                var_dump($dadosProdutos);
            }

            break;
    }

    header('Location: index.php?pag='.$page); 
    exit;
?>