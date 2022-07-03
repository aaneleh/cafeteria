<?php
    session_start();
    $jsonPedidos = file_get_contents("../pedidos.json");
    $jsonProdutos = file_get_contents("../produtos.json");
    $dadosPedidos = json_decode($jsonPedidos, true);
    $dadosProdutos = json_decode($jsonProdutos, true);

    $page = "index.php";
    $action = $_GET['action'];

    //verifica se esta logado antes de fazer qualquer alteração nos dados
    if(isset($_SESSION['logon']) and $_SESSION['logon'] == 1){
        $id = $_GET['id'];
        
        switch($action){

            //EXCLUIR PRODUTOS
            case 'delProd':
                array_splice($dadosProdutos, $id, 1);
                if(!file_put_contents("../produtos.json", json_encode($dadosProdutos, JSON_PRETTY_PRINT), LOCK_EX)){
                    echo("ERRO SALVANDO O ARQUIVO");
                } else echo("SUCESSO");
                $page = "index.php?pag=produtos";
                break;

            //EXCLUIR PEDIDOS
            case 'delPed':
                array_splice($dadosPedidos, $id, 1);
                if(!file_put_contents("../pedidos.json", json_encode($dadosPedidos, JSON_PRETTY_PRINT), LOCK_EX)){
                    echo("ERRO SALVANDO O ARQUIVO");
                } else echo("SUCESSO");
                $page = "index.php?pag=pedidos";
                break;

            //CONCLUIR PEDIDOS
            case 'concluirPed':
                if($dadosPedidos[$id]['feito'] == 1) {
                    $dadosPedidos[$id]['feito'] = 0;
                } else {                    
                    $dadosPedidos[$id]['feito'] = 1;
                }
                if(!file_put_contents("../pedidos.json", json_encode($dadosPedidos, JSON_PRETTY_PRINT), LOCK_EX)){
                    echo("ERRO SALVANDO O ARQUIVO");
                } else echo("SUCESSO");
                
                $page = "index.php?pag=pedidos";
                break;
        }
    }
    //NÃO PRECISA ESTAR LOGADO
    if ($action == "sair"){
        session_destroy();
        $page = "../index.html";
    }

    header('Location: '.$page); 
    exit;
?>