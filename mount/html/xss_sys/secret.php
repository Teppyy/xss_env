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
    if(isset($_SESSION['username'])){
        echo '<p>あなたのパスワードは'.$_SESSION['password'].'です。</p>';
    }else{
        header('Location: http://localhost:18081/xss_sys/home.php');
    }
?>
    </body>
</html>