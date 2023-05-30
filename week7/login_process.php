<?php
session_start();
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        if($username == 'bejo' && $pwd == "rahasia") {
            $_SESSION["username"] = $username;

            $waktu = mktime(0, 0, 0, date("m")+1, date("d"), date("Y"));
            if(isset($_POST["remember"])){
                setcookie("remember", $username, $waktu);
            } else {
                setcookie("remember", $username, time()-1);
            }

            header('location: home.php');
        } else {
            header('location: login.php?action=10');
        }
    } else {
        header('location: login.php?action=11');
    }
?>