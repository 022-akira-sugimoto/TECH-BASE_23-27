<?php
$filename = "Mission_1-25.txt"; 
$str = "テキスト見本<br>";
$file_handle=fopen($filename,"w"); 
fwrite($file_handle,$str);
fclose($file_handle); 
echo "書き込み成功!";