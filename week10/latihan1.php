<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            gap: 4px;
        }
        .outer-box {
            border: 2px solid black;
            display: inline-block;
            height: fit-content;
        }

        .inner-box {
            border: 1px solid red;
        }

        .box-1 .inner-box {
            margin-top: 20px;
            margin-left: 20px;
        }

        .box-2 .inner-box {
            margin-right: 20px;
            margin-bottom: 20px;
        }

        .box-3 .inner-box {
            margin-left: 20px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
<div class="outer-box box-1">
    <div class="inner-box">
        Box 1
    </div>
</div>

<div class="outer-box box-2">
    <div class="inner-box">
        Box 2
    </div>
</div>

<div class="outer-box box-3">
    <div class="inner-box">
        Box 3
    </div>
</div>
</body>
</html>
