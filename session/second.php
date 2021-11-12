<?php
session_start();
$sid=$_SESSION['sid'];
$spass=$_SESSION['spass'];
$cookie1=$_COOKIE['email'];
$cookie2=$_COOKIE['password'];
if(empty($sid) || empty($spass) ){

    header("location:first.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Welcome: <i><?php echo $sid.' '; echo $spass.' ';  echo $cookie1.' ' ; echo $cookie2.' ' ;?></i>
    <a href="logout.php">Logout</a>
</body>
</html>