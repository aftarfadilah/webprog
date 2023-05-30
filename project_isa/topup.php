<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(isset($_SESSION['login_user'])) {
    // Ambil data user yang login
    $sql = "SELECT * FROM user AS U".
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
        $idtabungan = $row['idtabungan'];
        $saldo = isset($row['saldo']) ? $row['saldo'] : 0;
        $saldo_iv = isset($row['saldo_iv']) ? $row['saldo_iv'] : 0;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // ambil data dari form
        $nominal = $_POST['nominal'];
        $customNominal = $_POST['customNominal'];

        $saldo_plain = decrypt_saldo($saldo);

        $nominalAkhir = 0;
        $nominalValid = true;
        if($nominal === "custom") {
            if($customNominal < 10000) {
                $error =  "Nominal minimal adalah 10.000";
                $nominalValid = false;
            }
            $nominalAkhir = $saldo_plain + $customNominal;
        } else {
            $nominalAkhir = $saldo_plain + $nominal;
        }

        $saldo_akhir_encryp = encrypt_saldo($nominalAkhir);

        // query untuk update saldo tabungan
        $sql_topup = "UPDATE tabungan SET saldo='$saldo_akhir_encryp' WHERE idtabungan='$idtabungan'";

        if($nominalValid) {
            if(mysqli_query($db,$sql_topup)) {
                $success = isset($_POST['nominal']) ? "Berhasil top-up: $nominal" : "Berhasil top-up: $customNominal";
            } else {
                $error = "Error Topup: $sql<br>" . mysqli_error($db);
            }
        }
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
    <title>Topup - Duon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/nav.php' ?>
<div class="content">
    <div class="container topup-container">
        <div class="card ">
            <h1>Pilih Nominal Top Up</h1>
            <?php
            if(isset($error)) {
                echo '<div class="error-message">' . $error . '</div>';
            }
            if(isset($success)) {
                echo '<div class="success-message">' . $success . '</div>';
            }
            ?>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <select class="form-control" id="nominal" name="nominal">
                        <option value="10000">Rp 10.000</option>
                        <option value="25000">Rp 25.000</option>
                        <option value="50000">Rp 50.000</option>
                        <option value="100000">Rp 100.000</option>
                        <option value="custom">Custom Nominal</option>
                    </select>
                </div><br>
                <span>Atau</span><br><br>
                <div class="form-group custom-nominal d-none">
                    <label for="customNominal">Nominal Custom</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number"  id="customNominal" name="customNominal" placeholder="Masukkan nominal sendiri...">
                    </div>
                </div><br>
                <button type="submit" class="btn btn-primary">Top Up</button>
            </form>
        </div>
    </div>
</div>
<?php include 'components/footer.php' ?>
</body>
</html>