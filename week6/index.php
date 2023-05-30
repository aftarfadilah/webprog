<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Week 6 - Array</title>
</head>
<body>
<?php
$links = array(
        "Ubaya" => "http://www.ubaya.ac.id",
        "Google" => "http://www.google.com",
       "Msn" => "http://www.msn.com",
        "Dell" => "http://www.dell.com"
);

echo "<ul>";
foreach($links as $key => $link) {
    echo "<li><a href='$link'>$key</a></li>";
}
echo "</ul>";

//print_r($links)

$prodi = array(
    1 => array(
            "fakultas" => "Farmasi"
    ),
    2 => array (
            "fakultas" => "Hukum"
    ),
    3 => array(
            "fakultas" => "Bisnis & Ekonomi",
            "prodi" => array(
                    1 => "Manajemen",
                    2 => "Akuntansi"
            )
    ),
    6 => array(
            "fakultas" => "Teknik",
            "prodi" => array(
                    3 => "Teknik Industri",
                    4 => "Teknik Informatika"
            )
    )
);

//print_r($prodi);
foreach($prodi as $key => $p) {
    if(isset($p["fakultas"])) {
        echo "<strong>$key - ".$p['fakultas']."</strong><br>";
    }
    if(isset($p["prodi"])) {
        echo "<ul>";
        foreach($p["prodi"] as $prKey => $pr) {
            echo "<li>$key$prKey - $pr</li>";
        }
        echo "</ul>";
    }
}
?>
</body>
</html>