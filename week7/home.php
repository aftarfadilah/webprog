<?php
session_start();
if(!isset($_SESSION["username"])) {
    header('location: login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="global.css">
    <title>Home</title>
</head>
<body>
<h1>Selamat datang <?php echo $_SESSION["username"] ?>!</h1>
<?php
if(isset($_COOKIE["remember"])) {
    echo '<p>Anda memilih untuk mengingat data login anda</p>';
}
?>
<div class="btn btn-danger">
    <a href="login.php?action=logout">Logout</a>
</div>
</body>
</html>