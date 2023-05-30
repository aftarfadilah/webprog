<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(isset($_SESSION['login_user'])) {
    $sql = "SELECT * FROM user WHERE email = '".$_SESSION['login_user']."'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if($count == 1) {
        $iduser = isset($row['iduser']) ? $row['iduser'] : 0;
        $email = isset($row['email']) ? $row['email'] : "";
        $nama = isset($row['nama']) ? $row['nama'] : "";
        $nama_arr = explode(" ", $nama);
        $nama_depan = isset($nama_arr[0]) ? $nama_arr[0] : "";
        $prv_key = isset($row['private_key']) ? $row['private_key'] : "";
        $nomor_hp = isset($row['nomor_hp']) ? $row['nomor_hp'] : "";
        $NIK = isset($row['NIK']) ? $row['NIK'] : "-";
        $NIK_plain = decrypt_saldo($NIK);
    } else {

    }

    if(isset($_GET['msg']) && $_GET['msg'] == "20") {
        $success = "Selamat datang di Duon, mohon lengkapi profil kamu terlebih dahulu";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // ambil data dari form
        $nama = $_POST['nama'];
        $NIK_post = isset($_POST['NIK']) ? $_POST['NIK'] : "-";
        $nomor_hp = $_POST['nomor_hp'];
//        $private_key = $_POST['private_key'];
        $email_post = $_POST['email'];

        $encrypted_nik = encrypt_saldo($NIK_post);

        $sql_user = "UPDATE user SET nama=?, NIK=?, nomor_hp=? WHERE email=?";
        $stmt_user = $db->prepare($sql_user);
        $stmt_user->bind_param('ssss', $nama, $encrypted_nik, $nomor_hp, $email);

        // eksekusi statement
        $stmt_user->execute();

        // cek apakah tabungan dengan iduser tertentu sudah ada di database
        $sql_cek = "SELECT COUNT(*) as count FROM tabungan WHERE iduser = ?";
        $stmt_cek = $db->prepare($sql_cek);
        $stmt_cek->bind_param('i', $iduser);
        $stmt_cek->execute();
        $count = $stmt_cek->get_result()->fetch_assoc()['count'];

        if ($count == 0) {
            $saldo_awal = 0;
            $encrypted_saldo = encrypt_saldo($saldo_awal);

            // jika belum ada, lakukan insert
            $insertQuery = "INSERT INTO tabungan (saldo, iduser) VALUES (?, ?)";
            $stmt_insert = $db->prepare($insertQuery);
            $stmt_insert->bind_param('si', $encrypted_saldo, $iduser);
            $stmt_insert->execute();

            $success = "Profil berhasil disimpan dan Tabungan telah berhasil dibuat.";
        } else {
            $success = "Profil berhasil disimpan.";
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
    <title>Profil - Duon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/nav.php' ?>
<div class="content">
    <div class="container">
        <br>
        <div class="card profil">
            <div class="card-header">
                <h1>Profil Anda   <span>#<?=$iduser?></span></h1> <a href="logout.php" class="txt-danger">logout</a>
            </div>
            <?php
            if(isset($error)) {
                echo '<div class="error-message">' . $error . '</div>';
            }
            if(isset($success)) {
                echo '<div class="success-message">' . $success . '</div>';
            }
            ?>
            <div class="card-body">
                <form action="#" method="post">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>
                    <br><br>

                    <label for="NIK">NIK:</label>
                    <input type="text" id="NIK" name="NIK" value="<?php echo $NIK_plain; ?>">
                    <span class="keterangan">Dapatkan keuntungan lebih dengan verifikasi NIK</span>
                    <br><br>
                    <label for="nomor_hp">Nomor HP:</label>
                    <input type="text" id="nomor_hp" name="nomor_hp" value="<?php echo $nomor_hp; ?>" required>
                    <br><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
                    <br><br>
                    <input type="submit" value="Simpan">
                    <br><br>

                </form>
                <form action="#" method="post">
                    <hr><br>
                    <div class="ganti-password">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                        <span class="keterangan">Masukkan untuk mengubah password</span><br>
                        <br><br>
                        <label for="password-ulang">Ulangi Password:</label>
                        <input type="password" id="password-ulang" name="password">
                        <br><br>

                        <input type="submit" value="Ubah Password">
                    </div>
                    <br><br>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'components/footer.php' ?>
<script>
    function generate_private_key(namaDepan) {
        var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+{}[];:,.<>?';
        var characters_length = characters.length;
        var private_key = '';
        private_key += namaDepan + '-';

        // Buat 10 karakter acak dari array karakter yang diberikan
        for (var i = 0; i < 10; i++) {
            private_key += characters.charAt(Math.floor(Math.random() * characters_length));
        }

        // Update value dari input yang memanggil method tersebut
        document.getElementById("private_key").value = private_key;
    }
</script>
</body>
</html>