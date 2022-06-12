<form action="POST.php" method="POST">
    <input type="hidden" name="action" value="editar">
    

    <?php 
        $jsonProdutos = file_get_contents("../produtos.json");
        $dadosProdutos = json_decode($jsonProdutos, true);

        if(isset($_GET['id']) and $_GET['id'] >= 0 and $_GET['id']< count($dadosProdutos)) {
            $id = $_GET['id'];
            $produto = $dadosProdutos[$id];

            echo "
                <h1>Editar Produto $id</h1>
                <input type='hidden' name='id' value=$id>

                <h2>Nome:</h2>
                <input type='text' name='nome' value=".$produto['nome'].">
            
                <h2>Descricao:</h2>
                <textarea name='descricao' rows='5'>".$produto['descricao']."</textarea>
            
                <h2>Preço:</h2>
                <input type='number' name='preco' step='.01' value=".$produto['preco'].">
            
                <h2>Categoria:</h2>
                <input list='categorias' name='categoria' value=".$produto['categoria'].">
                <datalist id='categorias'>
                    <?php
                        echo '<option value='doces'>';
                        echo '<option value='bebidas'>';
                    ?>
                </datalist>
            
                <h2>Imagem:</h2>
                <input type='file' name='imagem' value=".$produto['arquivo'].">
            
                <br><br>
                <input type='submit' class='clicavel buy-button' value='Adicionar'>
            ";
        } else {
            echo 'Produto inválido';
        }
    ?>

</form>