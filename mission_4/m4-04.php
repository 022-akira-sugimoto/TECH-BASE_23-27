<?php
//データベース接続設定
$dsn = 'mysql:dbname=(ユーザー名);host=localhost';
    $user = '(ユーザー名)';
    $password = '(パスワード)';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql ='SHOW CREATE TABLE tbtest';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        echo $row[1];
        echo "<br>";
    } 
    echo "<hr>";
    ?>