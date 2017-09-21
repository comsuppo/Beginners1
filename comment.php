<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <div>
            <form method="post" action="comment_end.php">
                <input type="hidden" name="title" value="<?php echo $_POST['title'] ?>" />
                <input type="hidden" name="article_id" value="<?php echo $_POST['article_id'] ?>" />
                名前　　　：<input type="text" name="name" /><br>
                本文　　　：<input type="text" name="body" /><br>
                パスワード：<input type="password" name="password" /><br>
                <input type="submit" value="コメント送信" />
            </form>
        </div>
    </body>
</html>