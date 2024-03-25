<?php
    session_start();
    if(isset($_COOKIE["PHPSESSID"])){
        setcookie("PHPSESSID", "", time() - 3600,"/");
    }
    $_SESSION = array();
    session_destroy();
    header('Location: http://localhost:18081/xss_sys/login.php');
?>