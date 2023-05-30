<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan 1</title>
</head>
<body>
<h1>Exercise 1 - The sender</h1>
<form action="catcher.php">
    <?php
    echo "<ol>";
    for($i = 0; $i < 10; $i++) {
        echo "<li><input type='text' name='hero[]'/></li>";
    }
    echo "</ol>";
    ?>
    <button type="submit">Submit</button>
</form>
<style>
    body {
        background-color: skyblue;
    }
    h1 {
        color: darkorange;
    }
    ol li {
        margin: 5px 0;
    }
    ol li input {
        padding: 4px 2px;
    }
    button[type="submit"] {
        background-color: slateblue;
        border: none;
        padding: 12px 24px;
        color: white;
        transition: all .2s;
    }
    button[type="submit"]:hover {
        letter-spacing: 2px;
    }
</style>
</body>
</html>