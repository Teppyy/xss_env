<!DOCTYPE html>
<html lang="jp" dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <button type="button" onclick="location.href='http://localhost:18081/xss_sys/home.php'" style="position: absolute; right: 50px; top: 0px"/>home</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/logout.php'" style="position: absolute; right: 0px; top: 0px"/>logout</button>
        <form action="" method="POST">
            <input name="content" type="text" placeholder="投稿内容">
            <button name="post" type="submit" value="1">投稿</button>
        </form>
<?php
    session_start();
    if(isset($_SESSION['username'])){
        if(isset($_POST['post'])){

            try{
                $db = new PDO('mysql:host=localhost;dbname=user','webserver','webpass');

                $sql = 'SELECT COUNT(*) FROM post';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch();
                $id = $result[0]+1;

                $sql2 = 'insert into post values(?,?,?)';
                $stmt2 = $db->prepare($sql2);
                $stmt2->execute(array($id,$_SESSION['display_name'],$_POST['content']));
                $result2 = $stmt2->fetch();

                $stmt = null;            
                $stmt2 = null;
                $db = null;
    
            }catch(PDOException $e){
                echo $e->getMessage();
                exit;
            }

            echo '投稿内容 : '.$_POST['content'];
            echo '<p>投稿が完了しました</p>';
        }
    }else{
        header('Location: http://localhost:18081/xss_sys/login.php');
    }
?>
    </body>
</html>

