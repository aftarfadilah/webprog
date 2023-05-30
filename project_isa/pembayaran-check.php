<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(!isset($_SESSION['login_user'])) {
    header('Location: login.php');
} else {
    $nominal = $_POST['nominal'];
    $inputPassword = $_POST['password'];
    // Ambil data user yang login
    $sql = "SELECT * FROM user AS U".
        " INNER JOIN tabungan AS T ON U.iduser = T.iduser" .
        " WHERE U.email = '".$_SESSION['login_user']."'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if($count == 1 && isset($_SESSION['pembayaran'])) {
        $password = $row['password'];
        if(password_verify($inputPassword, $password)) {
            $saldo = isset($row['saldo']) ? $row['saldo'] : 0;
            $saldo_plain = decrypt_saldo($saldo);
            if($saldo_plain > $nominal) {
                // Jika saldo cukup, lakukan transaksi

                // 1. Buatlah baris transaksi

                // Siapkan data untuk dimasukkan ke tabel transaksi
                $dataTransaksi = array(
                    'idpengirim' => $_SESSION['pembayaran']['idPengirim'],
                    'idTabunganPengirim' => $_SESSION['pembayaran']['idTabunganPengirim'],
                    'idpenerima' => $_SESSION['pembayaran']['idPenerima'],
                    'nominal' => $_SESSION['pembayaran']['nominal'],
                    'tanggal' => date('Y-m-d H:i:s')
                );

                // Lakukan query untuk memasukkan data ke tabel transaksi
                $queryTransaksi = "INSERT INTO transaksi (idtabungan, iduser, nominal, tgl_transaksi) VALUES (?, ?, ?, ?)";
                $stmtTransaksi = $db->prepare($queryTransaksi);
                $stmtTransaksi->bind_param('ssss',
                    $dataTransaksi['idTabunganPengirim'],
                    $dataTransaksi['idpengirim'],
                    $dataTransaksi['nominal'],
                    $dataTransaksi['tanggal']
                );

                if ($stmtTransaksi->execute()) {
                    // Jika berhasil memasukkan data ke tabel transaksi, lanjutkan ke tahap 2 dan 3

                    // 2. Kurangi saldo pengirim

                    // Ambil saldo pengirim terkini dari tabel tabungan
                    $querySaldoPengirim = "SELECT saldo FROM tabungan WHERE idtabungan = ?";
                    $stmtSaldoPengirim = $db->prepare($querySaldoPengirim);
                    $stmtSaldoPengirim->bind_param('s', $dataTransaksi['idTabunganPengirim']);
                    $stmtSaldoPengirim->execute();
                    $saldoPengirim = $stmtSaldoPengirim->get_result()->fetch_assoc()['saldo'];
                    $saldoPengirimPlain = decrypt_saldo($saldoPengirim);

                    // Kurangi saldo pengirim dengan nominal transfer
                    $saldoPengirimAkhir = $saldoPengirimPlain - $dataTransaksi['nominal'];
                    $saldoPengirimAkhirEncrypt = encrypt_saldo($saldoPengirimAkhir);


                    // Lakukan query untuk mengupdate saldo pengirim
                    $queryUpdateSaldoPengirim = "UPDATE tabungan SET saldo = ? WHERE idtabungan = ?";
                    $stmtUpdateSaldoPengirim = $db->prepare($queryUpdateSaldoPengirim);
                    $stmtUpdateSaldoPengirim->bind_param('si', $saldoPengirimAkhirEncrypt, $dataTransaksi['idTabunganPengirim']);
                    $stmtUpdateSaldoPengirim->execute();

                    // 3. Tambah saldo penerima

                    // Ambil saldo penerima terkini dari tabel tabungan
                    $querySaldoPenerima = "SELECT saldo FROM tabungan WHERE iduser = ?";
                    $stmtSaldoPenerima = $db->prepare($querySaldoPenerima);
                    $stmtSaldoPenerima->bind_param('i', $dataTransaksi['idpenerima']);
                    $stmtSaldoPenerima->execute();
                    $saldoPenerima = $stmtSaldoPenerima->get_result()->fetch_assoc()['saldo'];
                    $saldoPenerimaPlain = decrypt_saldo($saldoPenerima);

                    // Tambah saldo penerima dengan nominal transfer
                    $saldoPenerimaAkhir = $saldoPenerimaPlain + $dataTransaksi['nominal'];
                    $saldoPenerimaAkhirEncrypt = encrypt_saldo($saldoPenerimaAkhir);

                    // Lakukan query untuk mengupdate saldo penerima
                    $queryUpdateSaldoPenerima = "UPDATE tabungan SET saldo = ? WHERE iduser = ?";
                    $stmtUpdateSaldoPenerima = $db->prepare($queryUpdateSaldoPenerima);
                    $stmtUpdateSaldoPenerima->bind_param('si', $saldoPenerimaAkhirEncrypt, $dataTransaksi['idpenerima']);
                    $stmtUpdateSaldoPenerima->execute();

                    unset($_SESSION['pembayaran']);

                    $success = "Transaksi berhasil dilakukan!";
                    header('Location: pembayaran-berhasil.php');
                } else {
                    header('Location: pembayaran.php?msg=11'); // Terjadi kesalahan sistem
                }
            } else {
                // Jika saldo tidak cukup
                header('Location: pembayaran.php?msg=14'); // Saldo tidak cukup
            }
        } else {
            header('Location: pembayaran.php?msg=13'); // Password Salah

        }
    }
}



?>