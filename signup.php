<?php
// 1. ファイルの読み込み
require_once('Models/User.php');

// 2. データの受け取り
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$currentTime = date("Y/m/d H:i:s");

// 3. DBへのデータ保存
$user = new User();
$user->findByEmail($email, $password, $currentTime);


// リダイレクト
header('location:index.php');
exit;
?>