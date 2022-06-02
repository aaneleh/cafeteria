<div class="login">
        <form action="POST.php" method="POST" class="login-container">
            <h1>Login</h1>
            <h2>Usuário</h2>
            <input type="text" name="user" id="user">
            <h2>Senha</h2>
            <input type="password" name="pass" id="pass">
            <input type="submit" class="buy-button" value="Logar">
            <?php
                if(isset($_GET['status']) and $_GET['status'] == 'wrongpass'){
                    echo 'Senha Incorreta';
                }
            ?>
        </form>
</div>