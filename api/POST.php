<?php
    session_start();

    $jsonProdutos = file_get_contents("../produtos.json");
    $dadosProdutos = json_decode($jsonProdutos, true);
    $jsonProdutos = file_get_contents("../produtos.json");
    $dadosProdutos = json_decode($jsonProdutos, true);

    $page = "";

    $action = $_POST['action'];

    switch ($action){
        case 'login':
            $page = 'login&status=wrongpass'; //deixa por default um aviso de erro, se deu tudo certo é sobreescrito
            //compara a senha inserida com a senha fixa
            if($_POST['pass'] == '1234') { 
                //loga na sessão e vai pra pagina de pedidos
                $_SESSION['logon'] = true;
                $page = 'pedidos';
            }
            break;
        case 'adicionar':
            $page = "adicionar&status=invalid"; //deixa por default um aviso de erro, se deu tudo certo é sobreescrito

            //verifica se esta logado
            if(isset($_SESSION['logon']) and $_SESSION['logon'] == 1){
                
                //verifica se o nome, preco e categoria estão preenchidos
                if($_POST['nome'] != "" and $_POST['preco'] != "" and $_POST['categoria'] != "") {

                    //monsta o novo objeto
                    $novoProduto = new stdClass();
                    $novoProduto->nome= $_POST['nome'];
                    //$novoProduto->arquivo = $_POST[''];
                    $_POST['descricao'] == "" ? $novoProduto->descricao = "sem descrição" : $novoProduto->descricao = $_POST['descricao'];
                    $novoProduto->preco = $_POST['preco'];
                    $novoProduto->categoria = $_POST['categoria'];

                    //adicionar o novo objeto (produto) ao array e depois sobreescreve o json
                    array_push($dadosProdutos, $novoProduto);
                    if(!file_put_contents("../produtos.json", json_encode($dadosProdutos, JSON_PRETTY_PRINT), LOCK_EX)){
                        echo("ERRO SALVANDO O ARQUIVO");
                    } else {
                        echo("SUCESSO");
                        $page = "produtos";
                    }
                }
            }

            break;
        case 'editar':
            $page = "editar&status=invalid"; //deixa por default um aviso de erro, se deu tudo certo é sobreescrito
            
            //verifica se esta logado
            if(isset($_SESSION['logon']) and $_SESSION['logon'] == 1){
    
                //verifica se o id, nome, preco e categoria estão preenchidos
                if($_POST['id'] != "" and $_POST['nome'] != "" and $_POST['preco'] != "" and $_POST['categoria'] != "") {
                
                    $editadoProduto = new stdClass();
                    $editadoProduto->nome = $_POST['nome'];
                    $_POST['descricao'] == '' ? $editadoProduto->descricao = 'sem descrição' : $editadoProduto->descricao = $_POST['descricao'];
                    $editadoProduto->preco = floatval($_POST['preco']);
                    $editadoProduto->categoria = $_POST['categoria'];

                    //sobreescreve o produto editado
                    $dadosProdutos[$_POST['id']] = $editadoProduto;
                    if(!file_put_contents("../produtos.json", json_encode($dadosProdutos, JSON_PRETTY_PRINT), LOCK_EX)){
                        echo("ERRO SALVANDO O ARQUIVO");
                    } else {
                        echo("SUCESSO");
                        $page = "produtos";
                    }
                }
            }
            break;
    }

    header('Location: index.php?pag='.$page); 
    exit;
?>