<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $url = $_POST['url'];

    $makanan = array(
        'kode' => $kode,
        'nama' => $nama,
        'harga' => $harga,
        'url' => $url
    );

    if (!isset($_SESSION['makanan'])) {
        $_SESSION['makanan'] = array();
    }
    $_SESSION['makanan'][] = $makanan;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="">
    Kode Makanan : <input type="textbox" name="kode" placeholder="Kode Makanan"></input><br>
    Nama Makanan : <input type="textbox" name="nama" placeholder="Nama Makanan"></input><br>
    Harga Makanan : <input type="textbox" name="harga" placeholder="Harga Makanan"></input><br>
    URL Foto Makanan : <input type="textbox" name="url" placeholder="URL Foto Makanan"></input><br>

    <button type="submit" name="submit">Submit</button>
</form>
</body>
</html>