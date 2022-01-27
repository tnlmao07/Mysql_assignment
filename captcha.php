<?php
$r1=range(0,9);
$r1rand=array_rand($r1);
$r2=range(9,0);
$r2rand=array_rand($r2);
$pattern=$r1rand." + ".$r2rand." = ?";
$captchasum=$r1rand+$r2rand;
?>  