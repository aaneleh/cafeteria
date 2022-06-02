<div>
    <h1>Produtos</h1>
    <a class="buy-button" href="index.php?pag=adicionar">Novo Produto</a>
    <table border='1' class="tabela-produtos">
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
                    echo "<td> ... </td>";
                echo "</tr>";
            }
        ?>
    </table>

</div>