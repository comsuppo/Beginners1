<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
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
        <div>
            <form name="form" method="post" action="comment_end.php"  onSubmit="return checkForm();">
                <input type="hidden" name="title" value="<?php echo $_POST['title'] ?>" />
                <input type="hidden" name="article_id" value="<?php echo $_POST['article_id'] ?>" />
                名前　　　：<input type="text" name="name" size="30"/><br>
                本文　　　：<input type="text" name="body" size="30"/><br>
                <input type="submit" value="コメント送信" />
            </form>
        </div>
        <br>
        <div>
            <form action="board.php" method="post">
                <input type="hidden" name="title" value="<?php echo $_POST['title'] ?>" />
                <input type="hidden" name="article_id" value="<?php echo $_POST['article_id'] ?>" />
                <input type="submit" value="戻る"/>
            </form>
        </div>
    </body>
</html>