<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(isset($_SESSION['login_user'])) {
    // Ambil data user yang login
    $sql = "SELECT * FROM transaksi AS T".
        " INNER JOIN user AS U ON U.iduser = T.iduser" .
        " WHERE U.email = '".$_SESSION['login_user']."'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if($count > 0) {
        $email = isset($row['email']) ? $row['email'] : "-";
        $nama = isset($row['nama']) ? $row['nama'] : $email;
        $nomor_hp = isset($row['nomor_hp']) ? $row['nomor_hp'] : "-";
        $NIK = isset($row['NIK']) && $row['NIK'] != ""  ? $row['NIK'] : "-";
    } else {
        $error = "Kamu belum memiliki riwayat transaksi";
    }

    if (ob_get_length() > 0) {
        ob_clean();
    }
    require_once('library/TCPDF-main/tcpdf.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Create a new PDF object
        $pdf = new TCPDF(); // Add a page
        $pdf->AddPage(); // Set content
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Image('/img/Duon.png', 10, 10, 40, '', 'PNG');
        $pdf->Cell(0, 10, 'Email : ' . $email, 0, 1);
        $pdf->Cell(0, 10, 'Nama : ' . $nama, 0, 1);
        $pdf->Cell(0, 10, 'Nomor hp : ' . $nomor_hp, 0, 1);
        $pdf->Cell(0, 10, 'NIK : ' . $NIK, 0, 1);
        $pdf->Cell(0, 10, 'Riwayat Transaksi: ', 0, 1);
        $pdf->Cell(0, 10, '', 0, 1);
        if ($result->num_rows > 0) {
            // Table headers
            $headers = array('ID', 'Tanggal', 'Jenis', 'Nominal'); // Set table header font and style
            $pdf->SetFont('helvetica', 'B', 12);
            foreach ($headers as $header) {
                $pdf->Cell(40, 10, $header, 1, 0, 'C');
            }
            $pdf->Ln(); // Set table content font and style
            $pdf->SetFont('helvetica', '', 12); // Iterate over the rows and print data
            while ($row = $result->fetch_assoc()) {
                $pdf->Cell(40, 10, $row['idtransaksi'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['tgl_transaksi'], 1, 0, 'C');
                $pdf->Cell(40, 10, '-', 1, 0, 'C');
                $pdf->Cell(40, 10, $row['nominal'], 1, 0, 'C');
                $pdf->Ln();
            }
        } else {
            $error = "Riwayat transaksi tidak ditemukan.";
        } // Output PDF as a file
        $pdf->Output('riwayat.pdf', 'D');
        exit();
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
    <title>Riwayat Transaksi - Duon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/nav.php' ?>
<div class="content">
    <div class="container">
        <div class="card riwayat">
            <?php if($count > 0): ?>
                <form method="POST" action="">
                    <div>
                        <input class="btn-primary" type="submit" value="Cetak PDF"><br><br>
                    </div>
                </form>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                    </tr>
                    <?php while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                    <tr>
                        <td><?=$row['idtransaksi']?></td>
                        <td><?=$row['tgl_transaksi']?></td>
                        <td>-</td>
                        <td>Rp <?=$row['nominal']?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            <?php endif; ?>
            <?php
            if(isset($error)) {
                echo '<div>' . $error . '</div>';
            }
            ?>
        </div>
    </div>
</div>
<?php include 'components/footer.php' ?>
</body>
</html>