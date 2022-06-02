<?php
    session_start();
    
    $jsonPedidos = file_get_contents("../data/pedidos.json");
    $jsonProdutos = file_get_contents("../data/produtos.json");
    $dadosPedidos = json_decode($jsonPedidos, true);
    $dadosProdutos = json_decode($jsonProdutos, true);

    if(isset($_SESSION['logon']) and $_SESSION['logon'] == 1){
        $action = $_GET['action'];
        $id = $_GET['id'];
        
        switch($action){
            case 'delProd':
                array_splice($dadosProdutos, $id, 1);
                if(!file_put_contents("../data/produtos.json", json_encode($dadosProdutos, JSON_PRETTY_PRINT), LOCK_EX)){
                    echo("ERRO SALVANDO O ARQUIVO");
                } else {
                    echo("SUCESSO");
                }
                $page = "produtos";
                break;
            case 'delPed':
                array_splice($dadosPedidos, $id, 1);
                if(!file_put_contents("../data/pedidos.json", json_encode($dadosPedidos, JSON_PRETTY_PRINT), LOCK_EX)){
                    echo("ERRO SALVANDO O ARQUIVO");
                } else {
                    echo("SUCESSO");
                }
                $page = "pedidos";
                break;
        }
    }
    header('Location: index.php?pag='.$page); 
    exit;
?>