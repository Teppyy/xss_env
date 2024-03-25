<!DOCTYPE html>
<html lang="jp" dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/home.php'" style="position: absolute; right: 50px; top: 0px"/>home</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/logout.php'" style="position: absolute; right: 0px; top: 0px"/>logout</button>
<?php
    session_start();
    if(isset($_SESSION['display_name'])){
        echo '<p>こんにちは、'.$_SESSION['display_name'].'さん</p>';
    }else{
        header('Location: http://localhost:18081/xss_sys/login.php');
    }
?>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/edit_user.php'">ユーザ名変更</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/post.php'">投稿</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/view_post.php'">投稿一覧</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/secret.php'">パスワード</button>
<?php
    if($_SESSION['username']=='root'){
        echo '<button type="button" onclick="location.href='.
        "'http://localhost:18081/xss_sys/register_info.php'".
        '">周知内容変更</button>';
    }
?>
    </body>
</html>