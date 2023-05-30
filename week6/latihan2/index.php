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
<h1>Exercise 2 - The sender</h1>
<p>My favourite superheroes:</p>
<form action="catcher.php">
    <?php
    $superheroes = ["Batman", "Superman", "Ironman", "Thor", "Hulk", "Captain America", "Spiderman"];
    echo "<ol>";
    foreach($superheroes as $superhero) {
        echo "<li><label><input type='checkbox' name='hero[]' value='$superhero'/>$superhero</label></li>";
    }
    echo "</ol>";
    ?>
    <button type="submit">Submit</button>
</form>
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