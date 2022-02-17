<?php
//データベース接続設定
$dsn = 'mysql:dbname=(ユーザー名);host=localhost';
    $user = '(ユーザー名)';
    $password = '(パスワード)';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql = "CREATE TABLE IF NOT EXISTS tbtest"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
    $stmt = $pdo->query($sql);

    ?>