<?php
//データベース接続設定
$dsn = 'mysql:dbname=(ユーザー名);host=localhost';
    $user = '(ユーザー名)';
    $password = '(パスワード)';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    ?>