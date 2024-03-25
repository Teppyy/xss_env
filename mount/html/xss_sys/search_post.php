<!DOCTYPE html>
<html lang="jp" dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/home.php'" style="position: absolute; right: 50px; top: 0px"/>home</button>
        <button type="button" onclick="location.href='http://localhost:18081/xss_sys/logout.php'" style="position: absolute; right: 0px; top: 0px"/>logout</button>
        <form action="view_post.php" method="POST">
            <button name="view" type="submit" value="1">投稿一覧表示</button>
        </form>
<?php
    session_start();
    if(isset($_SESSION['username'])){
        if(isset($_GET['search'])){

            try{
                $db = new PDO('mysql:host=localhost;dbname=user','webserver','webpass');

                $sql = 'SELECT COUNT(*) FROM post';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch();
                $count = $result[0];

                $sql2 = 'SELECT id,user,content FROM post';
                $stmt2 = $db->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                echo '<br>';
                echo "<table border='1'>";
                for($i=0;$i<$count;$i++){
                    if(strpos($result2[$i]['content'],$_GET['search_word'])!==false){
                        echo "<tr>";
                        echo "<td>".$result2[$i]['id']."</td>";
                        echo "<td>".$result2[$i]['user']."</td>";
                        echo "<td>".$result2[$i]['content']."</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";

                $stmt = null;            
                $stmt2 = null;
                $db = null;

                echo '<form action="search_post.php" method="GET">';
                echo '<button name="search" type="submit" value="1">検索</button>';
                echo '<input name="search_word" type="text" value="'.$_GET['search_word'].'">';
                echo '</form>';

                if($_SESSION['username']=='root'){
                    echo '<br>';
                    echo '<button type="button" onclick="location.href='.
                    "'http://localhost:18081/xss_sys/delete_post.php'".
                    '">投稿一覧をまとめて削除</button>';
                }

            }catch(PDOException $e){
                echo $e->getMessage();
                exit;
            }
            
        }
    }else{
        header('Location: http://localhost:18081/xss_sys/login.php');
    }
?>
    </body>
</html>