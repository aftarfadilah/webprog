<?php
session_start();
$username_get = isset($_GET['username']) ? $_GET['username'] : "";
if(!isset($username_get)) {
    // Jika username telah di-set
    $_SESSION['username'] = $username_get;
}

$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action == "save") {
    // Jalankan jika user memilih aksi save
    setcookie('username', $username_get, time() + 86400 * 30); // 86400 = 1 Day
    header('location: ?');
} elseif ($action == "destroy") {
    // Jalankan jika user memilih aksi destroy

}

$username_session = isset($_SESSION['username']) ? $_SESSION['username'] : "";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="get">
        <?php if($username_get == "" && !isset($_COOKIE['username'])): ?>
        <!--    Jika username kosong, tampilkan form username -->
        <h1>Input 2</h1>
        <label for="studentName">
            <input type="text" name="username" />
        </label>
        <?php elseif($username_get != ""): ?>
         <!--    Jika username telah diisi, tanya aksi kepada user -->
            <h1>Hello <?php echo $username_get ?></h1>
            <p>Select an Action:</p>
            <label for="actionSave">
                <input type="radio" name="action" value="save" id="actionSave"> Save name to cookie
            </label><br>
            <label for="actionDelete">
                <input type="radio" name="action" value="destroy" id="actionDelete"> Destroy Cookie and Session
            </label>
        <?php elseif(isset($_COOKIE['username'])): ?>
        <!-- Jika user telah menyimpan session sebagai cookie -->
            <h1>Hello <?php echo $username_get ?></h1>
            <p>username has been stored as cookie</p>
            <p>Select an Action:</p>
            <label for="actionDelete">
                <input type="radio" name="action" value="destroy" id="actionDelete"> Destroy Cookie and Session
            </label>
        <?php endif; ?>


        <button type="submit">Submit</button>
    </form>
</body>
</html>