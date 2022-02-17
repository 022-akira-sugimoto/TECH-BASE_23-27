<?php
$filename = "Mission_1-24.txt"; 
$str = "テキスト見本";
$file_handle = fopen($filename,"a"); 
fwrite($file_handle,$str.PHP_EOL);
fclose($file_handle); 
echo "書き込み成功!<br>";
if(file_exists($filename)){
    $lines = file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
    echo $line."<br>";
    }
}
?>