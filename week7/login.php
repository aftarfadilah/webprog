<?php
session_start();
if(isset($_GET["action"]) == "logout") {
    unset($_SESSION["username"]);
} elseif(isset($_SESSION["username"])) {
    header('location: home.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="global.css">
    <title>Login</title>
</head>
<body>
<form action="login_process.php" method="post">
    <h1>Selamat datang pengguna setia!</h1>
    <?php
    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case "10":
                echo '<label class="lbl lbl-danger">Username atau Password salah!</label>';
                break;
            case "11":
                echo '<label class="lbl lbl-danger">Terjadi kesalahan, mohon coba lagi!</label>';
                break;
            case "logout":
                echo '<label class="lbl lbl-success">Berhasil Logout!</label>';
                break;
        }
    }
    ?>
    <div class="field">
        <label>
            <span>Username:</span>
            <input type="text" name="username" placeholder="aftar@fadilah.com" />
        </label>
    </div>
    <div class="field">
        <label>
            <span>Password: </span>
            <input type="password" name="password" placeholder="***"/>
        </label>
    </div>
    <div class="field">
        <label class="row">
            <input type="checkbox" name="remember"> Ingat saya
        </label>
    </div>
    <div class="field">
        <input class="btn btn-primary" type="submit" name="login" value="login" />
    </div>
</form>
</body>
</html>