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
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>
<body>
<div class="nav-container">
        <div class="wrapper">
            <nav>
                <ul class="nav-items">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="index.php#input">Input</a>
                    </li>
                    <li>
                        <a href="order.php">Order</a>
                    </li>
                    <li>
                        <a href="index.php#team">Our Team</a>
                    </li>
                </ul>
                <img class="logo-btn" src="images/Logo.png" alt="Logo Button" />
            </nav>
        </div>
</div>

<div class="list-menu">

<h1>Makanan List</h1>
    <div class="card-list">
        <?php
        foreach ($makanans as $makanan) {
            $kode = $makanan['kode'];
            $nama = $makanan['nama'];
            $harga = $makanan['harga'];
            $url = $makanan['url'];

            // Format the harga value to Indonesian Rupiah currency format
            $formattedHarga = 'Rp' . number_format($harga, 0, ',', '.');

            // Display the makanan details
            ?>
            <div class="card">
                <div class="banner" style="background-image: url('<?=$url?>')"></div>
                <div class="card-body">
                    <span class="nama"><?=$nama?></span>
                    <span class="harga"><?=$formattedHarga?></span>
                </div>


                <button class='add-to-cart' data-kode='<?=$kode?>' data-nama='<?=$nama?>' data-harga='<?=$harga?>' data-url='<?=$url?>'>Pilih</button>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<div class="pilihanku">
    <div class="pilihan-wrapper">
        <h1>Pilihanku</h1>
        <div class="total-wrapper hidden">
            <div id="cart-items">
                <ul id="cart-list"></ul>
            </div>
            <div class="total-separator">
                <div class="line"></div>
                <div class="plus-icon">
                    <span>+</span>
                </div>
            </div>

            <h2>Total: <span id="total">Rp0</span></h2>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var total = 0;

        $('.add-to-cart').click(function() {
            if($(".total-wrapper").hasClass("hidden")) {
                $(".total-wrapper").toggleClass("hidden");
            }
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var harga = $(this).data('harga');
            var url = $(this).data('url');
            $(this).prop("disabled",true);

            // Create the cart item HTML
            var cartItemHTML = '';
            cartItemHTML += '<li>';
            cartItemHTML += 'Nama Makanan: ' + nama + ' ';
            cartItemHTML += '(Rp' + harga.toLocaleString('id-ID') + ')';
            cartItemHTML += '</li>';

            // Append the cart item HTML to the cart items section
            $('#cart-list').append(cartItemHTML);

            // Add the harga value to the total
            total += parseInt(harga);

            // Update the total display with formatted harga
            $('#total').text('Rp' + total.toLocaleString('id-ID'));
        });
    });
</script>
</body>
</html>