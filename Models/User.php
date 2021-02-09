<?php

require_once('Model.php');

class User extends Model
{
    protected $table = 'users';

    // * (ユーザーを新規作成するメソッドの中身を追加する)
    public function create($data)
    {

    }

    // * (emailをもとにユーザーを取得するメソッド中身を追加する)
    public function findByEmail($data)
    {
        // フォームに入力されたemailで既に登録されていないかチェック
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $member = $stmt->fetch();
        if ($member['email'] === $email) {
            $msg = '同じメールアドレスが存在します。';
            $link = '<a href="signupForm.php">戻る</a>';
        } else {
            // 登録されていなければinsert
            $sql = "INSERT INTO users(email, password) VALUES (:email, :password)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();$msg = '会員登録が完了しました';
            $link = '<a href="signupForm.php">ログインページ</a>';
        }
        echo $msg;
        echo $link;

    }
}
