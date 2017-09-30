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
        
        
        
        <h1>Beginners BBS</h1>
        
        <div>
            <form action="create_article.php" >
                <input type="submit" value="新規記事を作成する" />
            </form>
        </div>
        <br>
        
        <div class="container">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th style="width:20%">
                            タイトル
                        </th>
                        <th style="width:60%">
                            説明
                        </th>
                        <th style="width:10%">
                            日時
                        </th>
                        <th style="width:10%">
                            削除
                        </th>
                    </tr>
                </thead>
                
                <tbody>

        
        <?php foreach($result as $row) : ?>
        <?php
        // XSS対策
        $id = htmlspecialchars($row['id']);
        $title = htmlspecialchars($row['title']);
        $description = nl2br(htmlspecialchars($row['description']));
        $time = htmlspecialchars($row['time']);
        ?>
                <tr>
                    <td>
                        <form action="board.php" method="post" name="form<?php echo $num ?>">
                        <input type="hidden" value="<?php echo $id ?>" name="article_id" />
                        <input type="hidden" value="<?php echo $title ?>" name="title" />
                        <input type="hidden" value="<?php echo $description ?>" name="description" />
                        <a  href="#" role="button" href="#" onclick="document.forms.form<?php echo $num ?>.submit()"><?php echo $title ?></a>
                    </form>
                    </td>
                    <td style"word-wrap: break-word;">
                        <?php echo $description ?>
                    </td>
                    <td>
                        <?php echo $time ?>
                    </td>
                    <td>
                        <form action="delete_article.php" method="post">
                            <input type="hidden" value="<?php echo $id ?>" name="id" />
                            <input type="submit" value="削除" />
                        </form>
                    </td>
                </tr>

        <?php $num += 1; ?>
        <?php endforeach; ?>
                            
                </tbody>
            </table>
        </div>
        
        
        
        
        <footer class="footer mt-5">
          <p class="bg-dark text-light text-center">&#169;2017 team beginners </p>
        </footer>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        
    </body>
</html>