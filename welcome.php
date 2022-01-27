<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>welcome</title>
    <style>
        body{
            background-image: url("images/adminbg.jpg");
            color: white;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        .container{
            width: 70%;
            height: 400px;
            background-color: rgb(45, 48, 59);
            margin-top: 100px;
            border: 2px solid rgb(189, 197, 217);
        }
        .block{
            padding: 100px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="block">
            <p>Welcome <?php   ?> ,You have been Successfully Registered!</p>
            <p><a href="login.php"><b>Click Here</b></a> To Login!</p>
        </div>
    </div>
</body>
</html>