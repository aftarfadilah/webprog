<?php 
$angka = mt_rand(1,10);
$theme = "";
if(isEven($angka)) $theme .= "latar-gelap";
else $theme .= "latar-cerah";
?>
<html>
<head>
</head>
<body class="<?php echo $theme ?>">
    <div class="header">
        <h1><?php echo "Fragebogen erfolgreich abgeschickt" ?></h1>
    </div>
    <div class="content">
        <p><?php echo "Vielen Dank für das Ausfüllen des Fragebogens. Eine
                    Mitarbeiterin wurde diesbezüglich verständigt und wird Sie
                    in Kürze abholen." ?></p>
        <?php
            $myteam = "Justice League";
            $yourteam = "The Avengers";
            $myleader = "Batman";
            $yourleader = "Ironman";
            echo "<u>$myteam</u> dalah kelompok pahlawan super pimpinan <b>“ $myleader ”</b>, sedangkan <u>$yourteam</u>, pimpinannya adalah <b>“ $yourleader ”</b>"
        ?>

        <br><br><hr>

        <?php 
        function isEven($num) {
            if($num % 2 == 0) return true;
            else return false;
        }
        $max = 6;
        for($x = 1; $x <= $max; $x++) {
            $className = "";

            // Check if paragraph is even
            $oddEven = isEven($x);
            if($oddEven) $className .= "warna-biru";
            else $className .= "warna-merah";

            $className .= " ";

            // Check if paragraph is first or last
            if($x == 1 || $x == $max) $className .= "huruf-tebal";

            echo "<p id='par$x' class='$className'>Paragraf number #$x</p>";
        }
        ?>

        <br><br><hr>

        <ul>
            <?php 
            $birthDate = 8;
            for($x = 0; $x <= 100; $x++)
                if($x % $birthDate == 0) echo "<li>$x</li>";
            ?>
        </ul>
    </div>
    <style>
        body {
            font-family: Georgia, serif
        }
        .content {
            color: #333;
        }
        .latar-cerah { background: #fdABAB; }
        .latar-gelap { background: #98A9B0; }
        .warna-merah { color: red; }
	    .warna-biru { color: blue; }
        .huruf-tebal { font-weight: bold; }
    </style>
</body>
</html>