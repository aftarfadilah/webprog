<html lang="id">
<head>
    <title>Week 5</title>
</head>
<body>
    <h1>Welcome to Week 5 - Data Communication</h1>
    <form method="post">
<!--        Input Text-->
        <p><label for="nama">Nama</label></p>
        <input type="text" id="nama" name="nama">
<!--        Input Radio-->
        <p>Gender</p>
        <label>
            <input type="radio" name="gender" value="pria">
            Pria
        </label>
        <label>
            <input type="radio" name="gender" value="wanita">
            Wanita
        </label>
<!--        Input Checkbox-->
        <p>Hobi</p>
        <label>
            <input type="checkbox"  name="hobi[]" value="Makan">
            Makan
        </label>
        <label>
            <input type="checkbox" name="hobi[]" value="Main">
            Main
        </label>
<!--     Select Option -->
        <p>
            <label for="kota">Kota Asal</label>
            <select id="kota" name="kota">
                <option value="Surabaya">Surabaya</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Surabaya">Gresik</option>
                <option value="Surabaya">Denpasar</option>
            </select>
        </p>
        <p>
            <button type="submit">Submit</button>
        </p>
    </form>
    <hr>
    <?php
        if(isset($_POST['nama']) && $_POST['nama'] != "") {
            $nama = $_POST['nama'];
            echo "<p>Nama: $nama</p>";
        }
        if(isset($_POST['gender'])) {
            $gender = $_POST['gender'];
            echo  "<p>Gender: $gender</p>";
        }
        if(isset($_POST['hobi'])) {
            echo "<p>Hobi: </p>";
            echo "<ul>";
            foreach($_POST['hobi'] as $hobi)
            {
                echo "<li>$hobi</li>";
            }
            echo "</ul>";
        }
        if(isset($_POST['kota'])) {
            $kota = $_POST['kota'];
            echo "<p>Kota Asal: $kota</p>";
        }
    ?>
</body>
</html>