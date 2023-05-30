<?php
session_start();
$username_get = isset($_GET['username']) ? $_GET['username'] : "";
//if (isset($_GET['username'])) {
//    $username = $_GET['username'];
//} else {
//    $username = "";
//}

// If username is inputted
$username_session = isset($_SESSION['username']) ? $_SESSION['username'] : "";
if($username_get != "") {
    $_SESSION['username'] = $username_get;
}

// If user select an action
$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action == "save") {
    // if user select save
    setcookie('username', $username_session, time() + 84000 * 30); // 1 Month later
    // 86400 = 1 Day
} elseif ($action == "destroy") {
    // if user select destroy
    setcookie('username', $username_get, time() - 3600); // 1 hour ago
    session_destroy();
    header('location: ?');
}
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
        <?php if($username_get == "" && $username_session == ""): ?>
            <!-- Jika tidak ada username dan tidak ada session -->
            <h1>Input</h1>
            <label for="studentName">
                <input type="text" name="username" />
            </label>
        <?php elseif($username_get != ""): ?>
            <!-- Jika user telah men-submit username -->
            <h1>Hello <?php echo $username_get ?></h1>
            <p>Select an Action:</p>
            <label for="actionSave">
                <input type="radio" name="action" value="save" id="actionSave"> Save name to cookie
            </label><br>
            <label for="actionDelete">
                <input type="radio" name="action" value="destroy" id="actionDelete"> Destroy Cookie and Session
            </label>
        <?php elseif($username_session != ""): ?>
            <!-- Jika terdapat cookie username -->
            <h1>Hello <?php echo $username_get ?></h1>
            <p>username has been stored as cookie</p>
            <p>Select an Action:</p>
            <label for="actionDelete">
                <input type="radio" name="action" value="destroy" id="actionDelete"> Destroy Cookie and Session
            </label>
        <?php endif; ?>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
