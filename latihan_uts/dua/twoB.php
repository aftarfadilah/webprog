<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TWoDimensional Array</title>
</head>
<body>
    <span>
        <form action="twoC.php" method="post">
            Select Subjects: <br>
                <?php
                $subjects = array("Computer" => array("Alpro", "OOP", "Database"),
                    "Chemical" => array("Chem 101", "Advance Chem"),
                    "biology" => array("Bio101", "Super Bio"));
                // echo "<pre>". print_r($subjects, true) ."</pre>" . "<br>";
//                echo print_r($subjects);
                $n = 0;
                if(isset($_GET['program'])){
                    foreach ($subjects as $key => $value) {
                        if(strtolower($_GET['program']) === strtolower($key)) {
                            echo "$key: ";
                            echo "<select name='matkul'>";
                            foreach ($value as $x => $y) {
                                echo "<option type='checkbox' name='subject[]' value=$y>$y</option>";

                            }
                            echo "</select>";
                        }
                    }
                }

                ?>
            <input type="url">

            <input type="submit" >
        </form>
    </span>
</body>
</html>