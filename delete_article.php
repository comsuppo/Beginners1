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

// データベースから該当記事を取得
$result = $db->query("select * from `article` where `id` = {$_POST['id']}");

// データベース操作時のメッセージ用
$result_message = '';

// 記事削除
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['password'])){
        // SQLインジェクション処理
        $id = $db->real_escape_string($_POST['id']);
        $password = $db->real_escape_string($_POST['password']);
        
        $db->query("delete from `article` where `id` = '$id' and `password` = '$password'");
        $count = $db->affected_rows;
        if($count == 1){
            header("Location: article.php");
        }else{
            $result_message = 'パスワードが違います';
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="bbs_style.css">
    </head>
    <body>
        <p><?php echo $result_message ?></p>
        <h1>記事削除</h1>
        <h2>以下の記事を削除しますか？</h2>
        <?php foreach($result as $row): ?>
        <div class="waku">
            <?php
            $id = htmlspecialchars($row['id']);
            $title = htmlspecialchars($row['title']);
            $time = htmlspecialchars($row['time']);
            ?>
            <span><?php echo $title ?></span><br>
            <span><?php echo $time ?></span>
        </div><br>
        <div>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>" />
                <input type="password" name="password" />
                <input type="submit" value="削除"/>
            </form>
        </div>
        <?php endforeach ?>
    </body>
</html>