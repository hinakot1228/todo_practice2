<?php

require_once('Model.php');

class User extends Model
{
    protected $table = 'users';

    // * (ユーザーを新規作成するメソッドの中身を追加する)
    public function login($email, $passoword, $currentTime)
    {
        // セッションを開始する
        session_start();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db_manager->$dbh->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $member = $stmt->fetch();
    
        // 指定したハッシュがパスワードに一致しているかチェック
        if (password_verify($_POST['password'], $member['password']){
            // DBのユーザー情報をセッションに保存
            // $_SESSION['id'] = $member['id'];
            // $_SESSION['email'] = $member['email'];
            $msg = 'ログインしました。';
            $link = '<a href="index.php">ホーム</a>';
        } else {
            $msg = 'メールアドレスもしくはパスワードが間違っています。';
            $link = '<a href="signinFrom.php">ホーム</a>';
        }
        echo $msg;
        echo $link;
    }

    // * (emailをもとにユーザーを取得するメソッド中身を追加する)
    // signup.phpで呼び出す関数

    public function findByEmail($email, $password, $currentTime)
    {
        // フォームに入力されたemailで既に登録されていないかチェック
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db_manager->dbh->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $member = $stmt->fetch();

        
        if ($member['email'] === $email) {
            $msg = '同じメールアドレスが存在します。';
            $link = '<a href="signupForm.php">戻る</a>';
        }
         else {
            // 登録されていなければinsert
            $sql = "INSERT INTO users(email, password) VALUES (:email, :password)";
            $stmt = $this->db_manager->dbh->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $msg = '会員登録が完了しました';
            $link = '<a href="signupForm.php">ログインページ</a>';
        }
        echo $msg;
        echo $link;
    }
}
