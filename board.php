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
            <title>Beginners BBS</title>
            
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="bbs_style.css">
   </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded mb-3">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav text-md-center nav-justified w-100">
                          <li class="nav-item active">
                            <a class="nav-link primary" href="index.html">home</a>
                          </li>
                          <li class="nav-item active">
                            <a class="nav-link primary" href="article.php">掲示板</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="https://gitpitch.com/comsuppo/is2017_team_beginners">gitpitch</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="https://github.com/comsuppo/Beginners1">github</a>
                          </li>
                    </ul>
              </div>
        </nav>
        
        
        <h1><?php echo $_POST['title']; ?></h1>
        
        <div>
            <?php echo $_POST['description']; ?>
        </div>
        <br>

        
        <div>
            <form action="comment.php" method="post">
                <input type="hidden" name="title" value="<?php echo $title ?>" />
                <input type="hidden" name="article_id" value="<?php echo $_POST['article_id'] ?>" />
                <input type="hidden" name="description" value="<?php echo $_POST['description'] ?>" />
                <input type="submit" value="コメントする" />
            </form>
        </div>
        <br>
        
        <?php foreach($result as $row): ?>
        <?php
        // XSS対策
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $body = nl2br(htmlspecialchars($row['body']));
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
    
            
        <footer class="footer mt-5">
          <p class="bg-dark text-light text-center">&#169;2017 team beginners </p>
        </footer>
    
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        
    </body>
</html>