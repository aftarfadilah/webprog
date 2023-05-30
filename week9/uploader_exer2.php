<?php
if($_FILES['photo1']['name'] && isset($_POST['rename1']) && $_FILES['photo2']['name'] && isset($_POST['rename2']))   {
    //if no errors...
    if(!$_FILES['photo1']['error'])  {
        $file_info = getimagesize($_FILES['photo1']['tmp_name']);
        if(empty($file_info)) {
            $message = "The uploaded file doesn't seem to be an image.";
        } else {
            // alternatively you can also use
            // if($_FILES['photo']['type'] == 'image/jpeg')
            if ($file_info['mime'] == 'image/jpeg') {
                // “It’s a JPEG!”;
            }
            //can't be larger than 1 MB
            if($_FILES['photo']['size'] > (1024000)) {
                $message = 'Oops!  Your file\'s size is to large.';
            } else {
                $ext1 = pathinfo($_FILES['photo1']['name'], PATHINFO_EXTENSION);
                $ext2 = pathinfo($_FILES['photo2']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['photo1']['tmp_name'], 'uploads/' . $_POST['rename1'] . '.' . $ext1);
                move_uploaded_file($_FILES['photo2']['tmp_name'], 'uploads/' . $_POST['rename2'] . '.' . $ext2);
            }

        }
        $message = 'Congratulations!  Your file was accepted.';
    } else {
        $message = 'Ooops! Your upload triggered the following error: '.$_FILES['photo']['error'];
    }

} else {
    die('You did not select any file!');
}
?>

<html>
<head>
    <title>Uploading Status</title>
</head>
<body>
<table>
    <tr>
        <th colspan="2"><h2>Uploaded File Info:</h2></th>
    </tr>
    <tr>
        <td colspan="2"><?php echo $message; ?></td>
    </tr>
    <tr>
        <td>
            <ul>
                <li>Sent file: <?php echo $_FILES['photo1']['name'];  ?></li>
                <li>File size: <?php echo $_FILES['photo1']['size'];  ?> bytes</li>
                <li>File type: <?php echo $_FILES['photo1']['type'];  ?></li>
                <li>Rename: <?=$_POST['rename1'].'.'.$ext1?></li>
            </ul>
            <img src="uploads/<?=$_POST['rename1'].'.'.$ext1?>" alt="" style="height: 500px">
        </td>
        <td>
            <ul>
                <li>Sent file: <?php echo $_FILES['photo2']['name'];  ?></li>
                <li>File size: <?php echo $_FILES['photo2']['size'];  ?> bytes</li>
                <li>File type: <?php echo $_FILES['photo2']['type'];  ?></li>
                <li>Rename: <?=$_POST['rename2'].'.'.$ext2?></li>
            </ul>
            <img src="uploads/<?=$_POST['rename2'].'.'.$ext2?>" alt="" style="height: 500px">
        </td>
    </tr>
</table>
</body>
</html>

