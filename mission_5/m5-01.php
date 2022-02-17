<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset=UTF-8>
        <title>"mission_5-01"</title> 
</head>
<body>
<!-- データベース接続設定------------------------------------------------------------------------------------------------------------------ -->
<?php
$dsn = 'mysql:dbname=(ユーザー名);host=localhost';
$user = '(ユーザー名)';
$password = '(パスワード)';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//SQLテーブル作成-----------------------------------------------------------------------------------------------------------------------------
    $sql = "CREATE TABLE IF NOT EXISTS m501"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "comtime TEXT,"
    . "pass TEXT"
    .");";
    $stmt = $pdo->query($sql);

//-- フォーム受け取りとフォーム入力の応答表示  --------------------------------------------------------------------------------------------------------- -->
error_reporting(E_ALL & ~E_NOTICE);//Noticeエラーを非表示にする(エラーが出ても正常に動作したため)
if(isset($_POST["str"]) && isset($_POST["name"])){//条件分岐 (フォーム"str" "name"に値が入っていればtrueを返す)
    if(empty($_POST["check"])){//編集モードか判別
        $str = $_POST["str"];//フォームの入力テキストを変数に定義
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        $check = $_POST["check"];
        if(empty($_POST["str"]) or empty($_POST["name"]) or empty($_POST["pass"])){//条件分岐:各フォームに文字が入力されているかどうかを判別
    }elseif($str != "" && $name != "" && $pass != ""){//条件分岐 (フォーム"str" "name"が空欄=false 投稿削除処理を行った際、この分岐がなければ空欄の行が追加されてしまう)
        echo $str." を受け付けました。<br><br>";
        }
    }
}

//データレコードの挿入---------------------------------------------------------------------------------------------------------------------------
    if(!empty($_POST["str"]) && !empty($_POST["name"]) && !empty($_POST["pass"]) && empty($_POST["edit"]) && empty($_POST["delete"])){
        
            $sql = $pdo -> prepare("INSERT INTO m501 (name,comment,comtime,pass) VALUES (:name,:comment,:comtime,:pass)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':comtime', $comtime, PDO::PARAM_STR);
            $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
            $formname = $_POST["name"];
            $formcomment = $_POST["str"];
            $formpass = $_POST["pass"];
            $name = $formname;
            $comment = $formcomment;
            $comtime = date("Y/m/d H:i:s");
            $pass = $formpass;
            $sql -> execute(); 
        }
    if(!empty($_POST["check"])){
        //編集データを書き込み
        $editname = $_POST["name"];
        $editstr = $_POST["str"];
        $id = (int)$_POST["check"];
        $name = $editname;
        $comment = $editstr."(編集済み)";
        $sql = 'UPDATE m501 SET name=:name,comment=:comment WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
    }

//削除処理-------------------------------------------------------------------------------------------------------------------------------------------
if(empty($_POST["edit"]) && empty($_POST["editpass"]) && empty($_POST["str"]) && empty($_POST["name"]) && isset($_POST["delete"]) && isset($_POST["delpass"])){//削除フォームに値が入ってる状態か確認
    $delete = $_POST["delete"];
    $delpass = $_POST["delpass"];
    $sql = 'SELECT * FROM m501';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach($result as $row){//投稿時に設定したパスワードを取得
        if($delete == $row['id']){
            $filepass = $row['pass'];
        }
    }
}
if($delpass != $filepass){//フォームに入力された削除用パスワードと投稿時に設定したパスワードが一致しない場合
    echo "パスワードが一致しません";
}elseif(isset($_POST["delete"]) && $_POST["delete"] != ""){//フォーム"delete"に値が入っていればtrueを返す]
    $id = $_POST["delete"];
    $sql = 'DELETE FROM m501 WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->execute();
}
//編集処理-------------------------------------------------------------------------------------------------------------------------------------------
if(!empty($_POST["edit"]) && !empty($_POST["editpass"]) && empty($_POST["str"]) && empty($_POST["name"]) && empty($_POST["delete"])){//編集フォームに値が入ってる状態か確認
    $editpass = $_POST["editpass"];//フォームに入力された編集用パスワードを取得
    $check = (int)$_POST["check"];//編集モード判別用変数
    $edit = (int)$_POST["edit"];//フォームに入力された編集番号を定義
    $sql = 'SELECT * FROM m501';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach($result as $row){//投稿時に設定したパスワードを取得
        if($edit == $row['id']){
            $filepass = $row['pass'];
        }
    }
if($editpass != $filepass){//フォームに入力された編集用パスワードと投稿時に設定したパスワードが一致しない場合
    echo "パスワードが一致しません";
}elseif(isset($_POST["edit"]) && $_POST["edit"] != ""){//フォーム"edit"に値が入っていればtrueを返す
    echo "編集する投稿番号:".$edit."<br>注意:パスワードは変更されません";//これはなくてもいいです
    $check = $_POST["check"];
    $sql = 'SELECT * FROM m501';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach($result as $row){
        if($row['id'] == $edit){
            $editcheck = $row['id'];//投稿(編集）番号
            $editname = $row['name'];//名前取得
            $editstr = $row['comment'];//本文取得
            $_POST["name"] = $editname;//取得した名前をフォームに代入
            $_POST["str"] = $editstr;//取得した本文をフォームに代入
        }
    }
}
}

//--フォーム入力欄-----------------------------------------------------------------------------------------------------------------------------
        if(isset($_POST["editpass"])){
            $editpass = $_POST["editpass"];//フォームに入力された編集用パスワードを取得
            if(isset($_POST["edit"]) && $editpass != $filepass){//フォームに入力された編集用パスワードと投稿時に設定したパスワードが一致しない場合
            
                //編集番号、名前、本文を空白で上書き　(これは編集処理が2重にされてしまうのを防ぐためのものだったと思います）
                $_POST["edit"] = "";
                $editname = "";
                $editstr  = "";
        }
    }
?>

<form action="" method="post">
<input type="hidden" name="check" value= "<?php if(isset($_POST["edit"]) && $_POST["edit"] != "" ){ echo $editcheck;} ?>">
<input type="text" name="name" value= "<?php if(!empty($_POST["edit"]) && $_POST["edit"] != ""){ echo $editname;} ?>" placeholder="名前を入力してください">
<input type="text" name="str" value= "<?php if(isset($_POST["edit"]) && $_POST["edit"] != ""){ echo $editstr;} ?>" placeholder="ここにテキストを入力">
<input type="text" name="pass" value= "" placeholder="パスワードを設定してください">
<input type="submit" name="submit">
<br>
<input type="number" name="delete" value="" placeholder="削除する投稿番号を入力">
<input type="text" name="delpass" value= "" placeholder="パスワードを入力">
<input type="submit" name="submit" value="削除">
<br>
<input type="number" name="edit" value="" placeholder="編集する投稿番号を入力">
<input type="text" name="editpass" value= "" placeholder="パスワードを入力">
<input type="submit" name="submit" value="編集">
</form>

<?php
//データレコードの抽出と表示--------------------------------------------------------------------------------------------------------------------------
    $sql = 'SELECT * FROM m501';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach($result as $row){
        echo $row['id'].' ';
        echo $row['name'].' ';
        echo $row['comment'].' ';
        echo $row['comtime'].'<br>';
        echo "<hr>";
    }
?>
</body>