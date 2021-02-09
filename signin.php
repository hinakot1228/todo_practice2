<?php
    // サインイン：既に会員である場合

    // 1. ファイルの読み込み
    require_once('Models/User.php');

    // セッションを開始する
    session_start();

    // 2. データの受け取り
    $email = $_POST['email'];
    $password = $_POST['password'];
    $currentTime = date("Y/m/d H:i:s");

    // 3. DBへのデータ保存
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $member = $stmt->fetch();

    // 指定したハッシュがパスワードに一致しているかチェック
    if (password_verify($_POST['password'], $member['passoword']){
        // DBのユーザー情報をセッションに保存
        $_SESSION['id'] = $member['id'];
        $_SESSION['email'] = $member['email'];
        $msg = 'ログインしました。';
        $link = '<a href="index.php">ホーム</a>';
    } else {
        $msg = 'メールアドレスもしくはパスワードが間違っています。';
        $link = '<a href="signinFrom.php">ホーム</a>';
    }
    echo $msg;
    echo $link;
?>