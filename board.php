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
        <title>
            Beginners BBS -
            <?php
            $title = htmlspecialchars($_POST['title']);
            echo $title;
            ?>
        </title>
        <link rel="stylesheet" type="text/css" href="bbs_style.css">
    </head>
    <body>
        <h1><?php echo $title ?></h1>
        
        <div>
            <form action="article.php">
                <input type="submit" value="戻る"/>
            </form>
        </div>
        <br>
        
        <div>
            <form action="comment.php" method="post">
                <input type="hidden" name="title" value="<?php echo $title ?>" />
                <input type="hidden" name="article_id" value="<?php echo $_POST['article_id'] ?>" />
                <input type="submit" value="コメントする" />
            </form>
        </div>
        <br>
        
        <?php foreach($result as $row): ?>
        <?php
        // XSS対策
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $body = htmlspecialchars($row['body']);
        $time = htmlspecialchars($row['time']);
        ?>
        <div class="board">
            <div>
                <span>名前:<?php echo $name ?></span>
                <span>時間:<?php echo $time ?></span>
            </div>
            <div>
                <span><?php echo $body ?></span>
            </div>
        </div>
        <br>
        <?php endforeach; ?>
        <div>
            <form action="article.php">
                <input type="submit" value="戻る"/>
            </form>
        </div>
    </body>
</html>