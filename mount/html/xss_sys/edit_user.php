<!DOCTYPE html>
<html lang="jp" dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <button type="button" onclick="location.href='http://localhost:18081/xss_sys/home.php'" style="position: absolute; right: 50px; top: 0px"/>home</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/logout.php'" style="position: absolute; right: 0px; top: 0px"/>logout</button>
        <form action="" method="POST">
            <input name="display_name" type="text" placeholder="ユーザ名">
            <button name="edit_user" type="submit" value="1">ユーザ名変更</button>
        </form>
<?php
    session_start();
    if(isset($_SESSION['username'])){
        if(isset($_POST['edit_user'])){

            try{
                $db = new PDO('mysql:host=localhost;dbname=user','webserver','webpass');

                $sql = 'UPDATE auth SET display_name=? WHERE username=?';
                $stmt = $db->prepare($sql);
                $stmt->execute(array($_POST['display_name'],$_SESSION['username']));

                $_SESSION['display_name'] = $_POST['display_name'];

                $stmt = null;
                $db = null;
    
            }catch(PDOException $e){
                echo $e->getMessage();
                exit;
            }

            echo '<p>ユーザ名変更が完了しました</p>';
        }
    }else{
        header('Location: http://localhost:18081/xss_sys/login.php');
    }
?>
    </body>
</html>

