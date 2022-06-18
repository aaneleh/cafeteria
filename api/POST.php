<?php
    session_start();

    $jsonProdutos = file_get_contents("../produtos.json");
    $dadosProdutos = json_decode($jsonProdutos, true);
    $jsonProdutos = file_get_contents("../produtos.json");
    $dadosProdutos = json_decode($jsonProdutos, true);

    $page = "";

    $action = $_POST['action'];

    switch ($action){
        /****** LOGIN ******/
        case 'login':
            $page = 'login&status=wrongpass'; //deixa por default um aviso de erro, se deu tudo certo é sobreescrito
            //compara a senha inserida com a senha fixa
            if($_POST['pass'] == '1234') { 
                //loga na sessão e vai pra pagina de pedidos
                $_SESSION['logon'] = true;
                $page = 'pedidos';
            }
            break;
        
        /****** ADICIONAR ******/
        case 'adicionar':
            $page = "adicionar&status=invalid"; //deixa por default um aviso de erro, se deu tudo certo é sobreescrito

            //verifica se esta logado
            if(isset($_SESSION['logon']) and $_SESSION['logon'] == 1){
                
                //verifica se o nome, preco e categoria estão preenchidos
                if($_POST['nome'] != "" and $_POST['preco'] != "" and $_POST['categoria'] != "") {

                    //monsta o novo objeto
                    $novoProduto = new stdClass();
                    $novoProduto->nome= $_POST['nome'];
                    $_POST['descricao'] == "" ? $novoProduto->descricao = "sem descrição" : $novoProduto->descricao = $_POST['descricao'];
                    $novoProduto->preco = $_POST['preco'];
                    $novoProduto->categoria = $_POST['categoria'];

                    //salvando imagem
                    $arquivo = $_FILES['file'];
                    $nomeArquivo = $arquivo['name'];
                    $localArquivo = $arquivo['tmp_name'];
                    //verificando por erros e tamanho do arquivo
                    if($arquivo['error'] == 0 and $arquivo['size'] < 100000){
                        $novoNomeArquivo = count($dadosProdutos).$nomeArquivo;
                        $novoProduto->arquivo = $novoNomeArquivo;

                        if(move_uploaded_file($localArquivo, '../images/'.$novoNomeArquivo)) {
                            echo("SUCESSO");
                        } else {
                            echo("ERRO SALVANDO A IMAGEM");
                            break;
                        }
                    } else {
                        echo("ERRO SALVANDO A IMAGEM");
                        break; //se não puder salvar o arquivo nem tenta salvar o resot
                    }

                    //adicionar o novo objeto (produto) ao array e depois sobreescreve o json
                    array_push($dadosProdutos, $novoProduto);
                    if(!file_put_contents("../produtos.json", json_encode($dadosProdutos, JSON_PRETTY_PRINT), LOCK_EX)){
                        echo("ERRO SALVANDO O ARQUIVO");
                        break;
                    } else {
                        echo("SUCESSO");
                        $page = "produtos";
                    }
                    
                }
            }
            break;

        /****** EDITAR ******/
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

                    if( $_FILES['file']['size'] !== 0 ) { //se foi inserida uma nova imagem
                        //salvando imagem
                        $arquivo = $_FILES['file'];
                        $nomeArquivo = $arquivo['name'];
                        $localArquivo = $arquivo['tmp_name'];
                        if($arquivo['error'] == 0 and $arquivo['size'] < 500000){ //verificando por erros e tamanho do arquivo
                            $novoNomeArquivo = count($dadosProdutos).$nomeArquivo;
                            $editadoProduto->arquivo = $novoNomeArquivo;
                            if(move_uploaded_file($localArquivo, '../images/'.$novoNomeArquivo)) {
                                echo("SUCESSO");
                            } else {
                                echo("ERRO 2 SALVANDO A IMAGEM");
                                break;
                            }
                        } else {
                            echo("ERRO 1 SALVANDO A IMAGEM");
                            break; //se não puder salvar o arquivo nem tenta salvar o resot
                        }
                    } else { //se não foi inserida uma imagem mantem o mesmo nome
                        $editadoProduto->arquivo = $dadosProdutos[$_POST['id']]['arquivo'];
                    }

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