<?php
//データベース接続設定
$dsn = 'mysql:dbname=(ユーザー名);host=localhost';
    $user = '(ユーザー名)';
    $password = '(パスワード)';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $id = 1;
    $name = "杉本聖(2)";
    $comment = "テスト2";
    $sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->execute();
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