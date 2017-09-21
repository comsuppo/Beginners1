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

// コメント書き込み
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['name']) && !empty($_POST['body']) && !empty($_POST['password']) && !empty($_POST['article_id'])){
        // SQLインジェクション処理
        $name = $db->real_escape_string($_POST['name']);
        $body = $db->real_escape_string($_POST['body']);
        $password = $db->real_escape_string($_POST['password']);
        $article_id = $db->real_escape_string($_POST['article_id']);
        
        $db->query("insert into `comment` (`name`, `body`, `password`, `article_id`) values ('{$name}', '{$body}', '{$password}', '{$article_id}')");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <div>
            <p>コメントが完了しました。</p>
            <form action="board.php" method="post">
                <input type="hidden" name="title" value="<?php echo $_POST['title'] ?>" />
                <input type="hidden" name="article_id" value="<?php echo $_POST['article_id'] ?>" />
                <input type="submit" value="記事へ戻る"/>
            </form>
        </div>
    </body>
</html>