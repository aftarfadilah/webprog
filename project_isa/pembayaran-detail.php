<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(!isset($_SESSION['login_user'])) {
    header('Location: login.php');
} else {
    // Ambil data user yang login
    $sql = "SELECT U.iduser, T.idtabungan ,T.saldo FROM user AS U".
        " INNER JOIN tabungan AS T ON U.iduser = T.iduser" .
        " WHERE U.email = '".$_SESSION['login_user']."'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if($count == 1) {
        $idUser = $row['iduser'];
        $idTabungan = $row['idtabungan'];
        $saldo = isset($row['saldo']) ? $row['saldo'] : 0;
    } else {
        header('Location: login.php');
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tampilkan detail recipient
    $tujuan = $_POST['tujuan'];
    $nominal = $_POST['nominal'];

    $sql = "SELECT iduser, nama, email FROM user WHERE email='$tujuan' OR nomor_hp ='$tujuan'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if($count == 1) {
        if($saldo >= $nominal) {
            $idPenerima = $row['iduser'];
            $_SESSION['pembayaran'] = array(
                    'emailTujuan' => $tujuan,
                    'nominal' => $nominal,
                    'idPenerima' => $idPenerima,
                    'idPengirim' => $idUser,
                    'idTabunganPengirim' => $idTabungan
                );
            $tujuanNama = $row['nama'];
            $tujuanEmail = $row['email'];
        } else {
            header('Location: pembayaran.php?msg=14'); // Saldo tidak cukup
        }
    } else {
        header('Location: pembayaran.php?msg=12'); // Penerima tidak ditemukan
    }
} else {
    header('Location: pembayaran.php?msg=11'); // Error method
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
    <title>Detail Pembayaran - Duon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/nav.php' ?>
<div class="content">
    <div class="content">
        <div class="container">
            <div class="card login">
                <h1>Detail Pembayaran</h1>
                <table>
                    <tr>
                        <td>Nama:</td>
                        <td><?=$tujuanNama?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?=$tujuanEmail?></td>
                    </tr>
                    <tr>
                        <td>Nominal:</td>
                        <td>Rp <?=$nominal?></td>
                    </tr>
                </table>
                <p>Pastikan data penerima sudah sesuai</p>
                <br>
                <form action="pembayaran-check.php" method="post">
                    <label>
                        <span>Password</span>
                        <input type="hidden" name="nominal" value="<?=$nominal?>" required>
                        <input type="password" name="password" required>
                    </label>
                    <button type="submit" class="btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    table + p {
        text-align: center;
        opacity: .75;
        margin-bottom: 24px;
    }

    td {
        padding: 10px;
        border: 1px solid #ccc;
    }

    td:first-child {
        font-weight: bold;
        background-color: #eee;
    }

</style>
<?php include 'components/footer.php' ?>
</body>
</html>