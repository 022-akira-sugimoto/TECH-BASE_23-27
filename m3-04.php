<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-04</title>
    </head>
    <body>

<!--フォーム受け取りとフォーム入力の応答表示  --------------------------------------------------------------------------------------------------------- -->
        <?php
        $filename = "Mission_3-04.txt";//テキストファイルを格納した変数を定義
        if(isset($_POST["str"]) && isset($_POST["name"])){//条件分岐 (フォーム"str" "name"に値が入っていればtrueを返す)
            if(empty($_POST["check"])){//編集モードか判別
                $str = $_POST["str"];//フォームの入力テキストを変数に定義
                $name = $_POST["name"];
                if($str != "" && $name != "" ){//条件分岐 (フォーム"str" "name"が空欄=false 投稿削除処理を行った際、この分岐がなければ空欄の行が追加されてしまう)
                echo $str." を受け付けました。<br><br>";
            
//テキストファイル書き込み用の変数の定義・ファイルの読み込み ----------------------------------------------------------------------------------------------
                $time = date("Y/m/d H:i:s");
                $file_handle = fopen($filename,"a"); //追記モード
                $count = count( file( $filename ) );//投稿番号取得のため、行番号を取得し変数として定義
                $num = (int)$count + 1;//phpの最初の行は0なので1を足した数を投稿番号として定義
        
//テキストファイル書き込み処理 ----------------------------------------------------------------------------------------------------------------------------
                fwrite($file_handle,$num."<>".$name."<>".$str."<>".$time."<>".PHP_EOL);//後のexplode処理のため区切り文字を挿入しておく
                fclose($file_handle);
                }
        }else{
            $editfile = file("Mission_3-04.txt");//テキストデータを行ごとに配列として読み込み
            $check = $_POST["check"];
            $pedit = $_POST["edit"];//入力された削除番号を新たな変数として定義
            $edit = $pedit;// 削除番号を再定義 (デバッグしていたら変数が二重に定義されたが、なぜこの処理が必要かはわかっていない。 よく分からんが動いてるのでヨシ！)
            $file_handle3 = fopen("Mission_3-04.txt","w"); //wモード(=上書き)でテキストファイルを開く
            for($i = 0; $i < count($editfile); $i ++ ){//63行目で定義した配列をループ処理する
                $exp = explode("<>",$editfile[$i]);//ループ処理内： 配列したテキストを1行ずつ区切り文字て区切る
                if($exp[0] == $check){//ループ処理内：(条件分岐: 投稿番号が削除番号と一致= true)
                    $editcheck = $exp[0];
                    $editname = $exp[1];
                    $editstr = $exp[2];
                    $newname = $_POST["name"];
                    $newstr = $_POST["str"];
                    fwrite($file_handle3,$exp[0]."<>".$newname."<>".$newstr."<>".$exp[3]."(編集済み)".PHP_EOL);
                }else{
                    fwrite($file_handle3,$editfile[$i]);
                    }
                }
            }
        }
//削除処理 ------------------------------------------------------------------------------------------------------------------------------------------------
        if(isset($_POST["delete"])){//フォーム"delete"に値が入っていればtrueを返す
        $pdelete = $_POST["delete"];//入力された削除番号を新たな変数として定義
            $delete = $pdelete;// 削除番号を再定義 (デバッグしていたら変数が二重に定義されたが、なぜこの処理が必要かはわかっていない。 よく分からんが動いてるのでヨシ！)
            $delfile = file("Mission_3-04.txt");//テキストデータを行ごとに配列として読み込み
            $file_handle2 = fopen("Mission_3-04.txt","w"); //wモード(=上書き)でテキストファイルを開く
            for($i = 0; $i < count($delfile); $i ++ ){//46行目で定義した配列をループ処理する
                $exp = explode("<>",$delfile[$i]);//ループ処理内： 配列したテキストを1行ずつ区切り文字て区切る
                if($exp[0] != $delete){//ループ処理内：(条件分岐: 投稿番号が削除番号と不一致= true)
                    fwrite($file_handle2,$delfile[$i]);//ループ処理内：テキストファイルに投稿を書き込み
                }else{//ループ処理内：投稿番号と削除番号が一致= true
                    fwrite($file_handle2,"<<この投稿は削除されました>>".PHP_EOL);//ループ処理内：投稿の代わりに削除メッセージを書き込み
                }
            }//ここからループ外
        fclose($file_handle2);
        }
        
//編集処理 ------------------------------------------------------------------------------------------------------------------------------------------------
        if(isset($_POST["edit"]) && $_POST["edit"] != ""){//フォーム"edit"に値が入っていればtrueを返す
        $pedit = $_POST["edit"];//入力された削除番号を新たな変数として定義
            $check = $_POST["check"];
            $edit = $pedit;// 削除番号を再定義 (デバッグしていたら変数が二重に定義されたが、なぜこの処理が必要かはわかっていない。 よく分からんが動いてるのでヨシ！)
            $editfile = file("Mission_3-04.txt");//テキストデータを行ごとに配列として読み込み
            $file_handle4 = fopen("Mission_3-04.txt","a"); //追記モードでテキストファイルを開く
            for($i = 0; $i < count($editfile); $i ++ ){//63行目で定義した配列をループ処理する
                $exp = explode("<>",$editfile[$i]);//ループ処理内： 配列したテキストを1行ずつ区切り文字て区切る
                if($exp[0] == $edit){//ループ処理内：(条件分岐: 投稿番号が削除番号と一致= true)
                    $editcheck = $exp[0];
                    $editname = $exp[1];
                    $editstr = $exp[2];
                    $_POST["name"] = $editname;
                    $_POST["str"] = $editstr;
                }
            }
        fclose($file_handle4);
        }
    ?>    
        
<!-- フォーム入力欄 --------------------------------------------------------------------------------------------------------------------------------- -->
        <form action="" method="post">
        <input type="hidden" name="check" value= "<?php if(isset($_POST["edit"]) && $_POST["edit"] != ""){ echo $editcheck;} ?>">
        <input type="text" name="name" value= "<?php if(isset($_POST["edit"]) && $_POST["edit"] != ""){ echo $editname;} ?>" placeholder="名前を入力してください">
        <input type="text" name="str" value= "<?php if(isset($_POST["edit"]) && $_POST["edit"] != ""){ echo $editstr;} ?>" placeholder="ここにテキストを入力">
        <input type="submit" name="submit">
        <br>
        <input type="number" name="delete" value="" placeholder="削除する投稿番号を入力">
        <input type="submit" name="submit" value="削除">
        <br>
        <input type="number" name="edit" value="" placeholder="編集する投稿番号を入力">
        <input type="submit" name="submit" value="編集">
        </form>
        
<!--テキストファイルをブラウザ表示 ------------------------------------------------------------------------------------------------------------------------ -->
        <?php
        if(file_exists($filename)){//条件分岐： テキストファイルが存在= true
        $lines = file($filename,FILE_IGNORE_NEW_LINES);//テキストファイルの内容を一行ずつ配列として読み込み
        foreach($lines as $line){//行末までループ処理
        $exp = explode("<>", $line);//区切り文字をブラウザに表示させないためにexplodeで区切っておく
        if($line == "<<この投稿は削除されました>>"){//条件分岐：explodeの書式に合わない行(削除した行)は単純にechoで表示させる
            echo $line."<br>";
        }else{//それ以外はexplodeの配列を表示させる
        echo $exp[0]." ".$exp[1]." ".$exp[2]." ".$exp[3]."<br>";//ループ処理内：テキストデータを一行書き込む
        }
        }//ここからループ外
        }
        ?>
    </body><!-- おわり --------------------------------------------------------------------------------------------------------------------------------- -->