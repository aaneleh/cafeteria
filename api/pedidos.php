<div class="pedidos">
    <h1>Lista de Pedidos</h1>
    <table class="tabela-pedidos">
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
                $feitoIcon = $pedido['feito'] == 1 ? "<i class='bi bi-check2-square'></i>" : "<i class='bi bi-app'></i>"; 
                echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$produto['nome']."</td>";
                    echo "<td>".$pedido['horario']."</td>";
                    echo "<td> <a href='GET.php?action=concluirPed&id=".$i."'> $feitoIcon </a> </td>";
                    echo "<td> <a href='GET.php?action=delPed&id=".$i."'> <i class='bi bi-x-lg'></i> </a> </td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>