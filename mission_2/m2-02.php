<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-02</title>
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
        if($str == "完了しました"){
            echo "お疲れ様です。";
        }
        $filename = "Mission_2-02.txt"; 
        $file_handle = fopen($filename,"w"); 
        fwrite($file_handle,$str.PHP_EOL);
        fclose($file_handle);
        
        }
        ?>
        
    </body>