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
    // print_r($_SESSION['makanan']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>Home</title>
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
                    <a href="#input">Input</a>
                </li>
                <li>
                    <a href="order.php">Order</a>
                </li>
                <li>
                    <a href="#team">Our Team</a>
                </li>
            </ul>
            <img class="logo-btn" src="images/Logo.png" alt="Logo Button" />
        </nav>
    </div>
</div>
<div class="header-cointainer">
    <div class="wrapper">
        <header>
            <div class="utama">
                <h1>
                    Simulasi JualBeli Data Makanan
                </h1>
                <br>
                <p>
                    Website ini dirancang untuk memudahkan pengguna dalam memasukkan data makanan secara cepat dan
                    efisien. Dengan tampilan yang simpel dan user-friendly, pengguna dapat dengan mudah simulasi data
                    tanpa mengalami kesulitan. Selain itu, website ini juga dilengkapi fitur untuk menghitung total pembelajaan.
                </p>
                <a class="btn-primary btn-arrow" href="#input">Mulai simpan data!</a>
            </div>

            <div class="cover-utama">
                <img src="images/utama.png" alt="" />
        </header>



        <div class="input-data">

            <div class="burger">
                <img src="images/burger.png">
            </div>

            <form method="post" id="form-input" action="?success=1#input">
                <div class="Judul">
                    <h1 id="input">Create Your Food</h1>
                </div>
                <div class="deskripsi">
                    <p>Masukan data makanan/minuman yang kamu sukai!</p>
                    <br>
                </div>
                <div class="Pertanyaan">
                    <div class="food-code">
                        <label for="kode-makanan">1.Food Code</label>
                        <br>
                        <input type="textbox" name="kode" placeholder="Kode Makanan" required></input>
                        <br>
                    </div>
                    <div class="food-name">
                        <br>
                        <label for="nama-makanan">2.Food Name</label>
                        <br>
                        <input type="textbox" name="nama" placeholder="Nama Makanan" required></input>
                        <br>
                    </div>
                    <div class="food-price">
                        <br>
                        <label for="harga-makanan">3.Food Price</label>
                        <br>
                        <input type="number" name="harga" min="0" placeholder="Harga Makanan" required></input>
                        <br>
                    </div>
                    <div class="url-food">
                        <br>
                        <label for="link-makanan">4.URL Picture Food</label>
                        <br>
                        <input type="textbox" name="url" placeholder="URL Foto Makanan" required>

                    </div>
                    <br>
                    <button type="reset">Reset</button>
                    <button class="submitBtn" type="submit" name="submit">Save</button>
            </form>
        </div>

        <!-- Peringatan PopOut -->
        <div class="modal-box">
            <h2>Berhasil</h2>
            <h3>Data kamu telah tersimpan</h3>

            <div class="buttons">
                <button class="close-btn">Close</button>
                <button><a href="order.php">Order Page</a></button>
            </div>
        </div>

        <div class="sushi">
            <img src="images/sushi.png" alt=""/>
        </div>


    </div>

    <div class="team-name">
        <div class="ourtim">
            <div class="minivec">
                <img src="images/garisTim.png" alt=""/>
            </div>
            <p>Our Team</p>
        </div>
        <div class="honor-team">
            <h1 id="team">Honored to partner up with <b>these teams</b></h1>
        </div>
        <div class="member-team">
            <div class="ansa-photos">
                <img src="images/Ansa.png" alt="">
                <div class="info">
                    <h1>Hilmy Irfansa</h1>
                    <p>
                        160421080
                    </p>
                </div>
            </div>

            <div class="aftar-photos">
                <img src="images/Aftar.png" alt="">
                <div class="info">
                    <h1> Aftar Fadilah</h1>
                    <p>160421095</p>
                </div>
            </div>
            <div class="garret-photos">
                <img src="images/Garret.png" alt="">
                <div class="info">
                    <h1>Garret Junior</h1>
                    <p>160421097</p>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    var urlParams = new URLSearchParams(window.location.search);
    console.log(">> url", urlParams)
    var success = urlParams.get('success');

    const subBtn =document.querySelector(".submitBtn"),
        closeBtn =document.querySelector(".close-btn"),
        section =document.querySelector(".modal-box");

    if(success) { //check if form success input
        section.classList.add("active")
    }

    closeBtn.addEventListener("click", () => {
        section.classList.remove("active");
    })

</script>
</body>

</html>