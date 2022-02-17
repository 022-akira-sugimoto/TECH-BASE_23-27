<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission1-27</title>
    </head>
    <body>
        <form action=""method="post">
            <input type="number" name="str">
            <input type="submit" name="submit">
        </form>
        <?php
        $str = $_POST["str"];
        $filename = "Mission_1-27.txt";
        $file_handle = fopen($filename,"a"); 
        fwrite($file_handle,$str.PHP_EOL);
        fclose($file_handle); 
            
        if(file_exists($filename)){
        $lines = file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
            if(((int)$line % 3) == 0 && ((int)$line % 5) == 0){
                echo "FizzBuzz<br>";
                }elseif(($line % 3) == 0){
                echo "Fizz<br>";
                }elseif(($line % 5) == 0){
                echo "Buzz<br>";
                }else{
                echo "$line"."<br>";
                }
            }
        }
        ?>
    </body>
</html>