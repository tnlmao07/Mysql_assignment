<style>
    .content{
            width: 110%;
            height: 550px;
            background-color: rgb(50, 54, 59);
            border-radius: 10px;
            border:2px solid rgb(189, 197, 217);
            padding:50px;
            color: white;
        }
</style>
<?php
include "connection.php";
$email=$_SESSION['sid'];
$sql="select * from users where email='$email';";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $demail="{$row['email']}";   
        $password="{$row['password']}";   
        $username="{$row['username']}";   
        $name="{$row['name']}";   
        $age="{$row['age']}";   
        $city="{$row['city']}";   
        $imagepath="{$row['imagepath']}";   
    }
}

?>
<div class="main">
    <h2>User Details</h2>
    <p>Email:    <?php echo $demail; ?></p><br>
    <p>Password:    <?php echo $password; ?></p><br>
    <p>Username:    <?php echo $username; ?></p><br>
    <p>Name:   <?php echo $name; ?></p><br>
    <p>Age:    <?php echo $age; ?></p><br>
    <p>City:    <?php echo $city; ?></p><br>
    <p>Imagepath:    <?php echo $imagepath; ?></p><br>
</div>