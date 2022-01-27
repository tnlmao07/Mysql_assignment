<?php
$error="";
session_start();
$sid=$_SESSION['sid'];
if(empty($sid)){
    header("location:login.php");
}
include "connection.php";
if(isset($_POST['submit'])){
    $oldpass=$_POST['oldpassword'];
    $newpass=$_POST['newpassword'];
    $cpass=$_POST['confirmpassword'];

    $sql="select password from users where email='$sid';";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $opass="{$row['password']}";   
        }
    }
    if($oldpass==$opass){
        if($newpass==$cpass){
            mysqli_query($conn,"UPDATE users SET password='$newpass' WHERE email='$sid';");
            header("Location:logout.php");
        }else{
            $error="Passwords Dont Match!";
        }
    }else{
        $error="Incorrect Old Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Change Password</title>
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
        <form method="post" enctype="multipart/form-data">
        <h2 style="font-size:28px;color:rgb(39, 45, 61);text-align:center; background-color:rgb(189, 197, 217);
        padding:5px;border-radius:10px">Change Password</h2>
            <div class="form-group">
                <label for="password">Old Password: </label>
                <input type="password" name="oldpassword" class="form-control" id="oldpassword" placeholder="Old Password">
            </div><br>
            <div class="form-group">
                <label for="password">New Password: </label>
                <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="New Password">
            </div><br>
            <div class="form-group">
                <label for="password">Confirm Password: </label>
                <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password">
            </div><br>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>	&nbsp;	&nbsp;	&nbsp;
        </form>
    </div>
</body>
</html>