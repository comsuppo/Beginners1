<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="bbs_style.css">
        <title>
            Beginners BBS -
            <?php
            echo $_POST['title'];
            ?>
             - コメント投稿
        </title>
        <link rel="stylesheet" type="text/css" href="bbs_style.css">
        <script type="text/javascript">
            <!--
            function checkForm(){
                if(document.form.name.value == "" ||
                    document.form.body.value == ""){
                        alert("すべての項目を入力してください。");
                        return false;
                    }
            }
            // -->
        </script>
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
        <div>
            <form name="form" method="post" action="comment_end.php"  onSubmit="return checkForm();">
                <input type="hidden" name="title" value="<?php echo $_POST['title'] ?>" />
                <input type="hidden" name="article_id" value="<?php echo $_POST['article_id'] ?>" />
                <input type="hidden" name="description" value="<?php echo $_POST['description'] ?>" />
                名前(30 文字以内)：<input type="text" name="name" style="width:500px" maxlength=30/><br>
                本文(400文字以内)：<textarea name="body" style="width:500px" rows=5 maxlength=400></textarea><br>
                <input type="submit" value="コメント送信" />
            </form>
        </div>
        <br>
        <div>
            <form action="board.php" method="post">
                <input type="hidden" name="title" value="<?php echo $_POST['title'] ?>" />
                <input type="hidden" name="article_id" value="<?php echo $_POST['article_id'] ?>" />
                <input type="hidden" name="description" value="<?php echo $_POST['description'] ?>" />
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