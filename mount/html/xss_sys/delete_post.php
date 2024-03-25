<!DOCTYPE html>
<html lang="jp" dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <button type="button" onclick="location.href='http://localhost:18081/xss_sys/home.php'" style="position: absolute; right: 50px; top: 0px"/>home</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/logout.php'" style="position: absolute; right: 0px; top: 0px"/>logout</button>
        <form action="" method="POST">
            <button name="delete" type="submit" value="1">削除</button>
        </form>
<?php
    session_start();
    if($_SESSION['username']=='root'){
        if(isset($_POST['delete'])){

            try{
                $db = new PDO('mysql:host=localhost;dbname=user','webserver','webpass');

                $sql = 'TRUNCATE TABLE post';
                $stmt = $db->prepare($sql);
                $stmt->execute();

                $stmt = null;
                $stmt2 = null;
                $db = null;
    
            }catch(PDOException $e){
                echo $e->getMessage();
                exit;
            }

            echo '<p>削除が完了しました</p>';
        }
    }else{
        header('Location: http://localhost:18081/xss_sys/login.php');
    }
?>
    </body>
</html>