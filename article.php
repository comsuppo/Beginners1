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
$result = $db->query("select * from `article` order by `id` desc");

?>

<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Beginners BBS</h1>
        <table border="1">
            <caption>記事一覧</caption>
            <tr style="background:#BDBDBD">
                <th>記事名</th>
                <th>作成時間</th>
            </tr>
            <?php foreach($result as $row) : ?>
            <tr>
                <?php
                $title = htmlspecialchars($row['title']);
                $time = htmlspecialchars($row['time']);
                ?>
                <td>
                    <form action="board.php" method="post" name="form<?php echo $num ?>">
                        <a href="#" onclick="document.forms.form<?php echo $num ?>.submit()"><?php echo $title ?></a>
                    </form>
                </td>
                <td>
                    <?php echo $time ?>
                </td>
            </tr>
            <?php $num += 1; ?>
            <?php endforeach; ?>
        </table>
    </body>
</html>