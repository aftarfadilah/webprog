<?php
if(isset($_POST['myNumber']) && isset($_POST['gachaNumber'])) {
    $myNum = $_POST['myNumber'];
    $gNum = $_POST['gachaNumber'];
    if($myNum == $gNum) {
        header('location: won.php?gNum='.$gNum);
    } else {
        header('location: lose.php?gNum='.$gNum);
    }
} else {
    header('location: index.php');
}
?>
