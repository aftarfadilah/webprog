<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Handling</title>
</head>
<body>
<h3>File Upload:</h3>
<form action="uploader_exer2.php" method="POST" enctype="multipart/form-data">
    <h3>1</h3>
    Select a file to upload: <br />
    <input type="file" name="photo1" accept=".jpg,.jpeg"><br ><br />

    Rename the image: <br />
    <input type="text" name="rename1" placeholder="Rename image"><br /><br />

    <h3>2</h3>
    Select a file to upload: <br />
    <input type="file" name="photo2" accept=".jpg,.jpeg"><br ><br />

    Rename the image: <br />
    <input type="text" name="rename2" placeholder="Rename image"><br /><br />

    <input type="submit" value="Upload File" >
</form>
</body>
</html>