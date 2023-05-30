<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(!isset($_SESSION['login_user'])) {
    header('Location: login.php');
}

if(isset($_SESSION['pembayaran'])) {
    unset($_SESSION['pembayaran']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran - Duon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/nav.php' ?>
<div class="content">
    <div class="content">
        <div class="container">
            <div class="card success-bayar">
                <h1>Pembayaran Berhasil</h1>
                Yey! Pembayaran mu telah diproses!
                <img src="img/assets/checked.png" />
                <a href="riwayat.php">
                    <div class="btn-primary">Lihat Riwayat</div>
                </a>
            </div>
        </div>
    </div>
</div>
<?php include 'components/footer.php' ?>
</body>
</html>