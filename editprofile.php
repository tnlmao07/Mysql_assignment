<style>
    .content{
            width: 110%;
            height: 700px;
            background-color: rgb(50, 54, 59);
            border-radius: 10px;
            border:2px solid rgb(189, 197, 217);
            padding:50px;
            color: white;
        }
</style>
<?php
include "connection.php";
$usernameerr="";
$nameerr="";
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $name=$_POST['name'];
    $city=$_POST['city'];
    $age=$_POST['age'];
    $email=$_SESSION['sid'];
    if(!empty($username) && !empty($name) && !empty($city) && !empty($age) && !empty($email)){
        $usernamev=input_field($_POST['username']);
        if(!preg_match("/^[a-z\d_]{2,20}$/i",$usernamev)){
            $usernameerr="* Username missing or incorrect!";
        }
        $namev=input_field($_POST['name']);
        if(!preg_match("/^[a-z ]{2,30}+$/i",$namev)){
            $nameerr="* Name missing or incorrect!";
        }
        if(empty($usernameerr) && empty($nameerr)){
            $sql="update users SET username='$username',name='$name',age='$age',city='$city' where email='$email';";
            $result=mysqli_query($conn,$sql);

            $tmp=$_FILES['file']['tmp_name'];
            $filename=$_FILES['file']['name'];
            $ext=pathinfo($filename,PATHINFO_EXTENSION);

            if($ext=="jpg" || $ext=="png" || $ext=="jpeg"){
                $fn=$email.".$ext";
                if(!empty($tmp)){
                    $imagepath="uploads/".$email."/".$fn;
                    
                    if(move_uploaded_file($tmp,$imagepath)){
                            mysqli_query($conn,"update users set imagepath='$imagepath';");
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
<div class="main">
        <h2 style="font-size:28px;color:rgb(39, 45, 61);text-align:center; background-color:rgb(189, 197, 217);
        padding:5px;border-radius:10px">Edit Profile</h2>
        <?php 
            if(!empty($error)){
        ?>
        <div style="margin-top: 40px;" class="alert alert-danger"> <?php echo $error;?></div>
        <?php
          }
        ?>
        <form action="" method="post" enctype="multipart/form-data" novalidate>
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
        <button type="submit" name="submit" class="btn btn-primary mb-3">Register</button>
        </form>
    </div>