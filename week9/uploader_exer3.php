<?php
function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $destination = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($destination, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return $destination;
}


if($_FILES['photo']['name'] && isset($_POST['rename']))   {
    //if no errors...
    if(!$_FILES['photo']['error'])  {
        $file_info = getimagesize($_FILES['photo']['tmp_name']);
        if(empty($file_info)) {
            $message = "The uploaded file doesn't seem to be an image.";
        } else {
            // alternatively you can also use
            // if($_FILES['photo']['type'] == 'image/jpeg')
            if ($file_info['mime'] == 'image/jpeg') {
                // “It’s a JPEG!”;
            }
            if($_FILES['photo']['size'] > (1024000)) {
                $message = 'Oops!  Your file\'s size is to large.';
            } else {
                $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $_POST['rename'] . '.' . $ext);
                $img = resize_image('uploads/' . $_POST['rename'] . '.' . $ext, 200, 300, TRUE);
                imagejpeg($img, 'uploads/' . $_POST['rename'] . '-300x200.' . $ext);
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
<?php echo $message; ?>
<h2>Uploaded File Info:</h2>
<ul>
    <li>Sent file: <?php echo $_FILES['photo']['name'];  ?>
    <li>File size: <?php echo $_FILES['photo']['size'];  ?> bytes
    <li>File type: <?php echo $_FILES['photo']['type'];  ?>
</ul>
<img src="uploads/<?=$_POST['rename'].'-300x200.'.$ext?>" alt="" style="height: 500px">
</body>
</html>

