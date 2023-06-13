<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Week 11 - Float</title>
    <style>
        #d1, #d2 {
            width: 150px;
            height: 75px;
        }
        #d1 {
            background-color: blue;
            float: right;
        }
        #d2 {
            background-color: red;
            float: left;
        }
        #header,#footer {
            height: 50px;
        }
        #header {
            background-color: green
        }
        #footer {
            background-color: red;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="header"></div>
        <div id="d1">&nbsp;</div>
        <div id="d2">&nbsp;</div>
        <div id="footer"></div>
    </div>
</body>
</html>
