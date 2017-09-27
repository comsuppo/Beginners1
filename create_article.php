<?php

$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$database = "beginners";
$dbport = 3306;

// mySQLに接続
$db = new mysqli($servername, $username, $password, $database, $dbport);
$db->set_charset('utf8');

// 接続確認
if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

// 記事作成
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['title']) && !empty($_POST['password'])){
        // SQLインジェクション処理
        $title = $db->real_escape_string($_POST['title']);
        $password = $db->real_escape_string($_POST['password']);
        
        $db->query("insert into `article` (`title`, `password`) values ('{$title}', '{$password}')");
        
        header("Location: article.php");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Beginners BBS - 記事作成</title>
        <link rel="stylesheet" type="text/css" href="bbs_style.css">
        <script type="text/javascript">
            <!--
            function checkForm(){
                if(document.form.title.value == "" ||
                    document.form.password.value == ""){
                        alert("すべての項目を入力してください。");
                        return false;
                    }
            }
            // -->
        </script>
    </head>
    <body>
        <h2>記事作成フォーム</h2>
        <div>
            <form method="post" name="form" onSubmit="return checkForm();">
                記事タイトル：<input type="text" name="title" size="30"/><br>
                パスワード　：<input type="password" name="password" size="30"/><br>
                <input type="submit" value="作成"/>
            </form>
        </div><br>
        <div>
            <form action="article.php">
                <input type="submit" value="戻る"/>
            </form>
        </div>
    </body>
</html>