<?php
    // サインイン：既に会員である場合

    // セッションを開始する
    session_start();
    // 1. ファイルの読み込み
    require_once('Models/User.php');

    // 2. データの受け取り
    $email = $_POST['email'];
    $password = $_POST['password'];
    $currentTime = date("Y/m/d H:i:s");

    // 3. DBへのデータ保存
    $user = new User();
    $user->login($email, $passoword, $currentTime); 

    // リダイレクト
    header('location:index.php');
    exit;   
?>