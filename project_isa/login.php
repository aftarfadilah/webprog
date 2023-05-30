<?php
session_start();
require "koneksidatabase.php";
require "functions.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    $sql = "SELECT iduser, password FROM user WHERE email = '$email'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        if(password_verify($password, $row['password'])) {
            $_SESSION['login_user'] = $email;
            header("location: index.php");
        } else {
            $error = "Email atau Password anda salah";
        }
    } else {
        $error = "Email atau Password anda salah";
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
    <title>Login - Duon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/nav.php' ?>
<div class="content">
    <div class="container">
        <div class="card login">
            <h1>Login</h1>
            <?php
            if(isset($error)) {
                echo '<div class="error-message">' . $error . '</div>';
            }
            ?>
            <form action="#" method="post">
                <label>
                    <span>Email</span>
                    <input type="email" name="email" placeholder="emailanda@contoh.com" required>
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" placeholder="password" required>
                </label>
                <button type="submit" class="btn-primary">Login</button>
                <div class="footer">
                    <p>Belum memiliki akun? <a href="daftar.php">Daftar Disini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'components/footer.php' ?>
</body>
</html>