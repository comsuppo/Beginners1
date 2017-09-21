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

// データベースからコメント取得
$result = $db->query("select * from `comment` where `article_id` = {$_POST['article_id']} order by `id` desc");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php foreach($result as $row): ?>
        <?php
        // XSS対策
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $body = htmlspecialchars($row['body']);
        $time = htmlspecialchars($row['time']);
        ?>
        <div>
            <div>
                <span>名前:<?php echo $name ?></span>
                <span>時間:<?php echo $time ?></span>
            </div>
            <div>
                <span><?php echo $body ?></span>
            </div>
        </div>
        
        <?php endforeach; ?>
    </body>
</html>