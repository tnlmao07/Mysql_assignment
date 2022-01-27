<?php
error_reporting(0);
session_start();
if(!empty($_SESSION['sid'])){
    header('Location:dashboard.php');
}
include "connection.php";
$error="";
if(isset($_POST['submit']) && isset($_POST['check'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $check=$_POST['check'];
    $sql = "SELECT password FROM users WHERE email='$email';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){  
        while($row = mysqli_fetch_assoc($result)){  
            $cpass="{$row['password']}";         
        }   
    }
    if(!empty($email) && !empty($check) &&!empty($password)){
        if($cpass==$password){
            session_start();
            $_SESSION['sid']=$email;
            header("Location:dashboard.php");
        }else{
            $error="Incorrect or Missing Password";
        }
    }else{
        $error="Fill in the fields";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        .main{
            background-color: rgb(45, 48, 59);
            padding: 20px;
            margin: 25px;
            border-radius: 15px;
            color:white;
            border:2px solid rgb(189, 197, 217);
        }
        body{
            margin-left: 300px;
            margin-right: 300px;
            background-image: url("images/adminbg.jpg");
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        .error{
            color: red;
        }
       
    </style>
</head>
<body>
    <div class="main">
        <?php 
            if(!empty($error)){
        ?>
        <div style="margin-top: 40px;" class="alert alert-danger"> <?php echo $error;?></div>
        <?php
          }
        ?>
        <form class="mar" method="post">
            <h2 style="font-size:28px;color:rgb(39, 45, 61);text-align:center; background-color:rgb(189, 197, 217);
        padding:5px;border-radius:10px">Login Panel</h2>
            <div class="form-group ">
                <label for="email">Email address:</label>
                <input type="email" name="email" class="form-control" id="email" onchange="cook()" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div><br>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div><br>
            <div class="form-group form-check">
                <input name="check" value="0" type="hidden">
                <input type="checkbox" name="check" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div><br>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>	&nbsp;	&nbsp;	&nbsp;
                <a href="register.php">New User</a>
        </form>
    </div>

</body>
</html>