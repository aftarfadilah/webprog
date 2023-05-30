<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(isset($_SESSION['login_user'])) {
    // Ambil data user yang login
    $sql = "SELECT U.iduser, U.nomor_hp, U.email, U.idroles, U.nama, T.* FROM user AS U".
        " INNER JOIN tabungan AS T ON U.iduser = T.iduser" .
        " WHERE U.email = '".$_SESSION['login_user']."'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if($count == 1) {
        $email = isset($row['email']) ? $row['email'] : "";
        $nama = isset($row['nama']) ? $row['nama'] : $email;
        $nomor_hp = isset($row['nomor_hp']) ? $row['nomor_hp'] : "";
        $NIK = isset($row['NIK']) ? $row['NIK'] : "";
        $saldo = isset($row['saldo']) ? $row['saldo'] : 0;
    } else {
        $email = "";
        $nama = "";
        $nomor_hp = "";
        $NIK = "";
    }

} else {
    header('Location: login.php');
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
    <title>Beranda - Duon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/nav.php' ?>
<div class="content">
    <div class="container">
        <br>
        <div class="heading-span">
            <h1>Selamat Datang, <?=$nama?></h1>
            <?php if($nama === $email): ?>
                <span>( ! ) Anda belum mengatur profil anda, atur <a href="profil.php">disini</a></span>
            <?php endif; ?>
        </div>
        <div class="card saldo">
            <div class="card-header">
                <h3>Saldo
            </div>
            <div class="card-body">
                <?php if($nama === $email): ?>
                    <h4>Lengkapi profil anda <a href="profil.php">disini</a> terlebih dahulu!</h4>
                <?php else: ?>
                    <h2>Rp <?=decrypt_saldo($saldo)?></h2>
                <?php endif; ?>
            </div>
        </div>
        <div class="actions">
            <a href="riwayat.php">
                <div class="card">
                    <div class="icon">
                        <img src="img/assets/history.png">
                    </div>
                    Riwayat Transaksi
                </div>
            </a>
            <a href="pembayaran.php">
                <div class="card">
                    <div class="icon">
                        <img src="img/assets/hand.png">
                    </div>
                    Pembayaran
                </div>
            </a>
            <a href="topup.php">
                <div class="card">
                    <div class="icon">
                        <img src="img/assets/top-up.png">
                    </div>
                    Top-up
                </div>
            </a>
            <a href="profil.php">
                <div class="card">
                    <div class="icon">
                        <img src="img/assets/user.png">
                    </div>
                    Profil
                </div>
            </a>
        </div>
    </div>
</div>


<?php include 'components/footer.php' ?>
</body>
</html>