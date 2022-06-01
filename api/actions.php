<?php
    $page = 'login';
    $action = $_POST['action'];

    switch ($action){
        case 'login':
            if($_POST['pass'] == '1234') {//senha fixa
                session_start();
                $_SESSION['user'] = $_POST['user'];
                $page = 'pedidos';
            }
            break;
    }

    header('Location: index.php?pag='.$page); 
    exit;

?>