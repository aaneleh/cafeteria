<?php

$jsonPedidos = file_get_contents("../pedidos.json");
$dadosPedidos = json_decode($jsonPedidos, true);
$novoPedido = new stdClass();
$page = "../produto.html?id=".$_GET['id']."&status=error";

if(isset($_GET['id']) and $_GET['id'] >= 0){
    $novoPedido->id_produto = intval($_GET['id']);
    $date = getdate();
    $horario = $date['year'].'-'.$date['mon'].'-'.$date['mday'].'; '.$date['hours'].':'.$date['minutes'].':'.$date['seconds'];
    $novoPedido->horario = $horario;
    $novoPedido->feito = 0;

    array_push($dadosPedidos, $novoPedido);
    if(!file_put_contents("../pedidos.json", json_encode($dadosPedidos, JSON_PRETTY_PRINT), LOCK_EX)){
        echo("ERRO SALVANDO O ARQUIVO");
    } else {
        echo("SUCESSO");
        $page = "../produto.html?id=".$_GET['id']."&status=ok";
    }
}

header('Location: '.$page); 
exit;

?>