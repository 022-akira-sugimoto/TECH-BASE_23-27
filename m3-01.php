<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-01</title>
    </head>
    <body>
        <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力してください">
        <input type="text" name="str" placeholder="ここにテキストを入力">
        <input type="submit" name="submit">
        </form>
        <?php
        $str = $_POST["str"];
        $name = $_POST["name"];
        $filename = "Mission_3-01.txt"; 
        if($str != "" && $name != "" ){
        echo $str." を受け付けました。<br><br>";
        $time = date("Y/m/d H:i:s");
        $file_handle = fopen($filename,"a"); 
        $count = count( file( $filename ) );
        $num = (int)$count + 1;
        fwrite($file_handle,$num."<>".$name."<>".$str."<>".$time.PHP_EOL);
        fclose($file_handle);}
        if(file_exists($filename)){
        $lines = file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
        echo $line."<br>";
        }
        }
        ?>
        
    </body>