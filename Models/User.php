<?php

require_once('Model.php');

class User extends Model
{
    protected $table = 'users';

    public function login($email, $password)
    {
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $member = $stmt->fetch();
    
        // 指定したハッシュがパスワードに一致しているかチェック
        if (password_verify($password, $member['password']))
        {
            // DBのユーザー情報をセッションに保存
            $_SESSION['id'] = $member['id'];
            $_SESSION['name'] = $member['name'];
            $_SESSION['email'] = $member['email'];
            $msg = $member['name'] . '様、こんにちは。ログインしました。';
            $link = '<a href="index.php">トップページ</a>';
        } else {
            $msg = 'メールアドレスもしくはパスワードが間違っています。';
            $link = '<a href="signinForm.php">戻る</a>';
        }
        echo $msg;
        echo $link;
    }
    
    // signup.phpで呼び出す関数
    public function findByEmail ($name, $email, $password)
    {
        // フォームに入力されたemailで既に登録されていないかチェック
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM users WHERE email = :email');

        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $member = $stmt->fetch();
        var_dump($member);
        

        if ($member['email'] === $email) {
            $msg = '同じメールアドレスが存在します。';
            $link = '<a href="signupForm.php">戻る</a>';
        }
         else {
            // 登録されていなければinsert
            $stmt = $this->db_manager->dbh->prepare('INSERT INTO users(name, email, password) VALUES (:name, :email, :password)');
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $msg = '会員登録が完了しました。';
            $link = '<a href="index.php">トップページ</a>';
        }
        echo $msg;
        echo $link;
    }
}
