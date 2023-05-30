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
<h1>Exercise 2 - The Catcher</h1>
<textarea rows="12">
<?php
    if(isset($_GET['hero'])) {
        foreach($_GET['hero'] as $hero) {
            if($hero !== "") echo $hero."\n";
        }
    }
?>
</textarea>
<style>
    body {
        background-color: skyblue;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    h1 {
        color: darkorange;
    }
</style>
</body>
</html>