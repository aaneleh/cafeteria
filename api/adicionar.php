<form class="form-novo" action="POST.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="adicionar">

    <h1>Novo produto</h1>

    <?php 
        if(isset($_GET['status']) and $_GET['status'] == 'invalid'){
            echo 'Dados inválidos';
        }

    ?>

    <h2>Nome:</h2>
    <input type="text" name="nome">

    <h2>Descricao:</h2>
    <input type="text" name="descricao">

    <h2>Preço:</h2>
    <input type="number" name="preco" step=".01">

    <h2>Categoria:</h2>
    <input list="categorias" name="categoria">
    <datalist id="categorias">
        <?php
            echo '<option value="doces">';
            echo '<option value="bebidas">';
            echo '<option value="salgados">';
        ?>
    </datalist>

    <h2>Imagem:</h2>
    <input type="file" name="file">

    <input type="submit" class="form-submit" value="Adicionar">
</form>