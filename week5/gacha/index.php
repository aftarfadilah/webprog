<?php
$rnd = mt_rand(1, 10);
?>
<html lang="id">
<head>
    <title>Week 5</title>
</head>
<body>
<h1>Welcome to Week 5 - Validator Gacha</h1>
<form method="post" action="validator.php">
    <p><label for="num">Selamat menggacha</label></p>
    <input type="number" id="num" name="myNumber" required>
    <input type="hidden" id="gNum" name="gachaNumber" value="<?php echo $rnd ?>" readonly>
    <p>
        <button type="submit">Submit</button>
    </p>
</form>
<hr>

</body>
</html>