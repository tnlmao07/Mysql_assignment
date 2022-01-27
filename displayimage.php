<?php
include "connection.php";
$sid=$_SESSION['sid'];
if(empty($sid)){
    header("location:login.php");
}
$sql="select imagepath from users where email='$sid';";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $imagepath="{$row['imagepath']}";   
    }
}

?>

<div>
    <img src="<?php echo $imagepath;?>" id="test" alt="No image found!!">
    <p id=""></p>
</div>