<?php
    session_start();

    $action = $_POST['action'];

    switch ($action){
        case 'login':
            $page = 'login&status=wrongpass';
            if($_POST['pass'] == '1234') {//senha fixa
                $_SESSION['logon'] = true;
                $page = 'pedidos';
            }

            break;
    }

    header('Location: index.php?pag='.$page); 
    exit;

?>