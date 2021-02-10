<?php
    session_start();
    $_SESSION = array(); //セッションの中身を全て削除
    session_destroy(); //セッションを破壊

    header('location:index.php');
    exit;
?>