<?php
session_start();

// Check if the 'makanan' session variable is set
if (isset($_SESSION['makanan'])) {
    // Retrieve the makanan items from the session
    $makanans = $_SESSION['makanan'];
} else {
    $makanans = [];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>
<body>
<h1>Makanan List</h1>
<?php
foreach ($makanans as $makanan) {
    $kode = $makanan['kode'];
    $nama = $makanan['nama'];
    $harga = $makanan['harga'];
    $url = $makanan['url'];

    // Format the harga value to Indonesian Rupiah currency format
    $formattedHarga = 'Rp' . number_format($harga, 0, ',', '.');

    // Display the makanan details
    echo "<p>";
    echo "Kode Makanan: $kode<br>";
    echo "Nama Makanan: $nama<br>";
    echo "Harga Makanan: $formattedHarga<br>";
    echo "URL Foto Makanan: <img src='$url' alt='$nama' style='max-width: 200px'><br>";

    // Add to Cart button
    echo "<button class='add-to-cart' data-nama='$nama' data-harga='$harga' >Add to Cart</button>";
    echo "</p>";
}
?>

<h1>Cart</h1>
<div id="cart-items">
    <ul id="cart-list"></ul>
</div>

<h2>Total: <span id="total">Rp0</span></h2>

<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>
