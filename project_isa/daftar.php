<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if(isset($_SESSION['login_user'])) {
    header('Location: profil.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ulangi_password = $_POST['ulangi_password'];
    $idroles = 2; // Customer

    if ($password === $ulangi_password) {
        // Proses penyimpanan data user ke database
        // Enkripsi password terlebih dahulu
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (email, password, idroles) VALUES ('$email', '$password_hash', '$idroles')";
        if (mysqli_query($db, $sql)) {
            $_SESSION['login_user'] = $email;
            $success = "Kamu telah berhasil terdaftar, silahkan login <a href='login.php'>Disini</a>!";
            header('Location: profil.php?msg=20');
        } else {
            $error = "Error: $sql<br>" . mysqli_error($db);
        }

    } else {
        $error = "Password tidak sama";
    }
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
    <title>Daftar - Duon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/nav.php' ?>
<div class="content">
    <div class="container">
        <div class="card daftar">
            <h1>Daftar</h1>
            <?php
            if(isset($error)) {
                echo '<div class="error-message">' . $error . '</div>';
            }
            if(isset($success)) {
                echo '<div class="success-message">' . $success . '</div>';
            }
            ?>
            <form action="#" method="post">
                <label>
                    <span>Email</span>
                    <input type="email" name="email" placeholder="emailanda@contoh.com" required value="<?php if(isset($email)) echo $email ?>">
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required>
                </label>
                <label>
                    <span>Ulangi Password</span>
                    <input type="password" name="ulangi_password" required>
                </label>
                <button type="submit" class="btn-primary">Daftar</button>
                <div class="footer">
                    <p>Sudah memiliki akun? <a href="login.php">Login disini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'components/footer.php' ?>
</body>
</html>