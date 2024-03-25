<div class="signin">
    <form action="" method="GET">

<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=user','webserver','webpass');
        $sql = 'SELECT info FROM info';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        echo '<p>周知 : '.$result_info[0]['info'].'</p>';

    }catch(PDOException $e1){
        echo $e1->getMessage();
        exit;
    }
    
    if(isset($_GET['signin'])){
        $username = $_GET['username'];
        $password = $_GET['password'];

        try{
            $sql2 = 'SELECT * FROM auth WHERE username=? AND password=?';
            $stmt2 = $db->prepare($sql2);
            $stmt2->execute(array($username,$password));
            $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $stmt2 = null;
            $db = null;

            if($result[0]['username']!=0){
                //session_set_cookie_params(0, '/; SameSite=None', '', true, false); //chrome csrf用
                session_set_cookie_params(0, '/; SameSite=None', '', false, false); //firefox
                session_start();
                //session_regenerate_id();//セッションフィクセーション対策
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['display_name'] = $result[0]['display_name'];
                header('Location: http://localhost:18081/xss_sys/home.php');
                exit;
            }else{
                echo '<label for="signin-id">アカウント名</label>';
                echo '<input id="signin-id" name="username" type="text" value="'.$_GET['username'].'">';
                echo '<br>';
                echo '<label for="signin-pass">パスワード</label>';
                echo '<input id="signin-pass" name="password" type="text" value='.$_GET['password'].'>';
                echo "<p>認証情報が間違っています。</p>";
            }
        }catch(PDOException $e2){
            echo $e2->getMessage();
            exit;
        }
    }else{
        echo '<label for="signin-id">アカウント名</label>';
        echo '<input id="signin-id" name="username" type="text" placeholder="メールアドレスを入力">';
        echo '<br>';
        echo '<label for="signin-pass">パスワード</label>';
        echo '<input id="signin-pass" name="password" type="text" placeholder="パスワードを入力">';
    }
?>
    <br>
        <button name="signin" type="submit" value="1">ログインする</button>
    </form>
</div>