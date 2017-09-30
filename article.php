<?php

$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$database = "beginners";
$dbport = 3306;

// フォームカウント用
$num = 1;

// mySQLに接続
$db = new mysqli($servername, $username, $password, $database, $dbport);
$db->set_charset('utf8');

// 接続確認
if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

// データベースから降順で読み込み
$result = $db->query("select * from `article` where `flag` = '0' order by `id` desc");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Beginners BBS</title>
        <link rel="stylesheet" type="text/css" href="bbs_style.css">
    </head>
    <body>
        <h1>Beginners BBS</h1>
        
        <div>
            <form action="create_article.php" >
                <input type="submit" value="新規記事を作成する" />
            </form>
        </div>
        <br>
        
        <?php foreach($result as $row) : ?>
        <?php
        // XSS対策
        $id = htmlspecialchars($row['id']);
        $title = htmlspecialchars($row['title']);
        $description = nl2br(htmlspecialchars($row['description']));
        $time = htmlspecialchars($row['time']);
        ?>
        
        <div class="waku">
            <div class="link">
                <span>
                    <form action="board.php" method="post" name="form<?php echo $num ?>">
                        <input type="hidden" value="<?php echo $id ?>" name="article_id" />
                        <input type="hidden" value="<?php echo $title ?>" name="title" />
                        <input type="hidden" value="<?php echo $description ?>" name="description" />
                        <a href="#" onclick="document.forms.form<?php echo $num ?>.submit()"><?php echo $title ?></a>
                    </form>
                </span>
                <br>
                <span><?php echo $time ?></span>
            </div>
            <div class="right">
                <span>
                    <form action="delete_article.php" method="post">
                        <input type="hidden" value="<?php echo $id ?>" name="id" />
                        <input type="submit" value="削除" />
                    </form>
                </span>
            </div><br>
        </div>
        <br>
        
        <?php $num += 1; ?>
        <?php endforeach; ?>
        
    </body>
</html>