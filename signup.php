<?php
// 1. ファイルの読み込み
require_once('Models/User.php');

// 2. データの受け取り
$email = $_POST['email'];
$password = $_POST['password'];
$currentTime = date("Y/m/d H:i:s");

// 3. DBへのデータ保存
$users = new Usser();
$users->findByEmail([$email, $password]);

// リダイレクト
header('location:index.php');
exit;
?>