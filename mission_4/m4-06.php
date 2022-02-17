<?php
//データベース接続設定
$dsn = 'mysql:dbname=(ユーザー名);host=localhost';
    $user = '(ユーザー名)';
    $password = '(パスワード)';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql = 'SELECT * FROM tbtest';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach($result as $row){
        echo $row['id'].' ';
        echo $row['name'].' ';
        echo $row['comment'].'<br>';
        echo "<hr>";
    }
    
    ?>