<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(!isset($_SESSION['login_user'])) {
    header('Location: login.php');
}

if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if($msg == "11") {
        $error = "Terjadi kesalahan saat mengirim. Coba lagi beberapa menit.";
    } else if($msg == "12") {
        $error = "Tujuan dengan email/no.Hp yang dimasukkan tidak ditemukan";
    } else if($msg == "13") {
        $error = "Password salah";
    } else if($msg == "14") {
        $error = "Saldo anda tidak cukup";
    }
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
            <div class="card login">
                <h1>Pembayaran</h1>
                <?php
                if(isset($error)) {
                    echo '<div class="error-message">' . $error . '</div><br>';
                }
                if(isset($success)) {
                    echo '<div class="success-message">' . $success . '</div><br>';
                }
                ?>
                <form action="pembayaran-detail.php" method="post">
                    <label>
                        <span>No.Hp / Email Tujuan</span>
                        <input type="text" name="tujuan" placeholder="email.tujuan@contoh.com" required>
                    </label>
                    <label>
                        <span>Nominal</span>
                        <input type="number" name="nominal" placeholder="Minimal Rp 1,-" required>
                    </label>
                    <button type="submit" class="btn-primary">Kirim</button>
                    <span style="font-size: 10px; opacity: .25; text-align: center; margin-top: 6px;">082123456789</span>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'components/footer.php' ?>
</body>
</html>