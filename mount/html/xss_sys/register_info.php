<!DOCTYPE html>
<html lang="jp" dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <button type="button" onclick="location.href='http://localhost:18081/xss_sys/home.php'" style="position: absolute; right: 50px; top: 0px"/>home</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/logout.php'" style="position: absolute; right: 0px; top: 0px"/>logout</button>
        <form action="" method="POST">
            <input name="info" type="text" placeholder="周知内容">
            <button name="register" type="submit" value="1">周知情報の登録</button>
        </form>
<?php
    session_start();
    if($_SESSION['username']=='root'){
        if(isset($_POST['register'])){

            try{
                $db = new PDO('mysql:host=localhost;dbname=user','webserver','webpass');

                $sql = 'UPDATE info SET info=?';
                $stmt = $db->prepare($sql);
                $stmt->execute(array($_POST['info']));
                $result = $stmt->fetch();

                $stmt = null;            
                $db = null;
    
            }catch(PDOException $e){
                echo $e->getMessage();
                exit;
            }

            echo '<p>周知内容の変更が完了しました</p>';
        }
    }else{
        header('Location: http://localhost:18081/xss_sys/home.php');
    }
?>
    </body>
</html>

