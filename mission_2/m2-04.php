<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-04</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="str" placeholder="ここにテキストを入力">
        <input type="submit" name="submit">
        </form>
        <?php
        $str = $_POST["str"];
        $filename = "Mission_2-04.txt"; 
        if($str != ""){
        echo $str." を受け付けました。<br><br>";
        $file_handle = fopen($filename,"a"); 
        fwrite($file_handle,$str.PHP_EOL);
        fclose($file_handle);}
        if(file_exists($filename)){
        $lines = file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
        echo $line."<br>";
        }
        }
        ?>
        
    </body>