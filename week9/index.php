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
Select a file to upload: <br >
<form action="file_uploader.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="photo" accept=".jpg,.jpeg"><br >
    <input type="submit" value="Upload File" >
</form>
</body>
</html>