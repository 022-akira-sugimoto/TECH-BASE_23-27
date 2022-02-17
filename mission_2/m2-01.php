<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-01</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="str" value="コメント">
        <input type="submit" name="submit">
        </form>
        <?php
        $str = $_POST["str"];
        if($str != ""){
        echo $str." を受け付けました。";
        }
        ?>
        
    </body>