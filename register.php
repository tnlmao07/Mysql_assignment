<?php
$emailerr="";
$passworderr="";
$nameerr="";
$usernameerr="";
include "connection.php";
include "captcha.php";
if(isset($_POST['submit'])){
    $error="";
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $city=$_POST['city'];
    if(!empty($_POST['gender'])){
        $gender=$_POST['gender'];
    }
    if(!empty($email) && !empty($password) && !empty($age) && !empty($gender) && !empty($name) ){
            if($_POST['captcha']==$_POST['captchahidden']){
                $emailv=input_field($_POST['email']);
                if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$emailv)){
                    $emailerr="* Email format didnt match!";
                }
                $passwordv=input_field($_POST['password']);
                if(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/",$passwordv)){
                    $passworderr="* Password format didnt match!";
                }
                $usernamev=input_field($_POST['username']);
                if(!preg_match("/^[a-z\d_]{2,20}$/i",$usernamev)){
                    $usernameerr="* Username missing or incorrect!";
                }
                $namev=input_field($_POST['name']);
                if(!preg_match("/^[a-z ]{2,30}+$/i",$namev)){
                    $nameerr="* Name missing or incorrect!";
                }
                $tmp=$_FILES['file']['tmp_name'];
                $filename=$_FILES['file']['name'];
                $ext=pathinfo($filename,PATHINFO_EXTENSION);
                $sql="select email from users where email='$email'";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0){  
                    while($row = mysqli_fetch_assoc($result)){  
                        $cemail="{$row['email']}";         }   
                }
                if($cemail==$email){
                    header("Location:login.php");
                }else{
                    if($ext=="jpg" || $ext=="png" || $ext=="jpeg"){
                            mkdir("uploads/".$email);                        
                            $tmp=$_FILES['file']['tmp_name'];
                            $filename=$_FILES['file']['name'];
                            $ext=pathinfo($filename,PATHINFO_EXTENSION);
                            $fn=$email.".$ext";
                            if(!empty($tmp)){
                                $imagepath="uploads/".$email."/".$fn;
                                
                                if(move_uploaded_file($tmp,$imagepath)){
                                    /* if(mysqli_query($conn,"insert into users(email,username,password,name,age,city
                                    ,imagepath) values('$email','$username','$password','$name',$age,'$city','$imagepath')")){
                                        
                                        header('Location:welcome.php');

                                    }else{
                                        $error="Database Error!";
                                    } */
                                    if($email==mysqli_query($conn,"select email from users where email='$email';")){
                                        $error="User Already Exists!";
                                    }else{
                                        mysqli_query($conn,"insert into users(email,username,password,name,age,city
                                        ,imagepath) values('$email','$username','$password','$name',$age,'$city','$imagepath')");
                                        header("Location:welcome.php");
                                    }
                                }else{
                                    $error="Uploading error";
                                }
                            }else{
                                $error="Select a file";
                            }   
                        }else{
                        $error="Only JPG,PNG,JPEG formats supported!";
                    }
                }
            }else{
                $error="Captcha doesnt match!";
            }
    }else{
        $error="Fill all the fields!";
    }
}
function input_field($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        body{
            margin-left: 300px;
            margin-right: 300px;
            background-image: url("images/adminbg.jpg");
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        .main{
            background-color: rgb(45, 48, 59);
            padding: 20px;
            margin: 25px;
            border-radius: 15px;
            color:white;
            border:2px solid rgb(189, 197, 217);
        }
        label{
            font-weight: 600;
        }
        input{
            margin-top: 10px;
        }
        .error{
            color: rgb(252, 218, 217);
        }
    </style>
</head>
<body>
    <div class="main">
        <h2 style="font-size:28px;color:rgb(39, 45, 61);text-align:center; background-color:rgb(189, 197, 217);
        padding:5px;border-radius:10px">Registration Panel</h2>
        <?php 
            if(!empty($error)){
        ?>
        <div style="margin-top: 40px;" class="alert alert-danger"> <?php echo $error;?></div>
        <?php
          }
        ?>
        <form action="" method="post" enctype="multipart/form-data" novalidate>
        <div class="form-group ">
            <label for="email">Email address: </label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <span class="error"><?php echo $emailerr;?></span>
        </div><br>
        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <span class="error"><?php echo $passworderr;?></span>
        </div><br>
        <div class="form-group">
            <label for="username">Username: </label>
            <input type="text" name="username" class="form-control" placeholder="Userame">
            <span class="error"><?php echo $usernameerr;?></span>
        </div><br>
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" name="name" class="form-control" placeholder="Name">
            <span class="error"><?php echo $nameerr;?></span>
        </div><br>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" name="age" class="form-control" id="exampleFormControlInput1" placeholder="Age">
        </div><br>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" name="city" class="form-control" id="exampleFormControlInput2" placeholder="City">
        </div><br>
        <div class="form-group">
            <label>Gender:</label>
            <div class="custom-control custom-radio">
                <input type="radio" id="male" value="Male" name="gender" class="custom-control-input">
                <label class="custom-control-label" for="male">Male</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="female" value="Female" name="gender" class="custom-control-input">
                <label class="custom-control-label" for="female">Female</label>
            </div>
        </div><br>
        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlFile1">Upload Image:</label><br><br>
                <input type="file" name="file" class="form-control-file" id="file">  
            </div>
        </div><br>
        <div class="form-group">
            <div class="form-group">
                <label for="captcha">Captcha: <?php echo $pattern;?></label><br>
                <input type="number" name="captcha" class="form-control-input" id="captcha">  
                <input type="hidden" name="captchahidden" value="<?php echo $captchasum; ?>" class="form-control-input" id="captchahidden">  
            </div>
        </div><br>
        <button type="submit" name="submit" class="btn btn-primary mb-3">Register</button>
        </form>
    </div>
    
</body>
</html>