<div>
    <h1>Lista de Pedidos</h1>
    <table border='1' class="tabela-pedidos">
        <tr>
            <th>ID</th>
            <th>Pedido</th>
            <th>Horário</th>
            <th>Feito</th>
            <th>Cancelar</td>
        </tr>

        <?php
            for($i =0; $i < count($dadosPedidos); $i++){
                $pedido = $dadosPedidos[$i];
                $produto = $dadosProdutos[$pedido['id_produto']];
                echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$produto['nome']."</td>";
                    echo "<td>".$pedido['horario']."</td>";
                    echo "<td>[ ]</td>";
                    echo "<td> <a href='GET.php?action=delPed&id=".$i."'> X </a> </td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>