<div class="produtos">
    <h1>Produtos</h1>
    <a id="botao-novo-produto" href="index.php?pag=adicionar">
        Novo Produto
    </a>
    <table class="tabela-produtos">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Deletar</td>
            <th>Editar</td>
        </tr>
        <?php
            for($i =0; $i < count($dadosProdutos); $i++){
                $produto = $dadosProdutos[$i];
                echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$produto['nome']."</td>";
                    echo "<td>".$produto['preco']."</td>";
                    echo "<td>".$produto['descricao']."</td>";
                    echo "<td> <a href='GET.php?action=delProd&id=".$i."'> <i class='bi bi-x-lg'></i> </a> </td>";
                    echo "<td> <a href='index.php?pag=editar&id=$i'> <i class='bi bi-three-dots'></i> </a> </td>";
                echo "</tr>";
            }
        ?>
    </table>

</div>