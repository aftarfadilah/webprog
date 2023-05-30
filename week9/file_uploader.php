<?php
if($_FILES['photo']['name'])   {
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
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/fotobaru.' . $ext);
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
</body>
</html>

