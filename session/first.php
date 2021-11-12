<?php
$login=[
    ["email"=>"ashutosh.mulay@neosoftmail.com","pass"=>"123456"],
    ["email"=>"ashu@gmail.com","pass"=>"12345678"],
    ["email"=>"ashutosh.mulay@gmail.com","pass"=>"1234"],
];

if(isset($_POST['sub'])){
   
    $email=$_POST['email'];
    $password=$_POST['password'];

    foreach($login as $i){
        if($i["email"]==$email && $i["pass"]==$password){
            session_start();
            $_SESSION['sid']=$email;
            $_SESSION['spass']=$password;
            setcookie("email",$email,time()+3600*24*30*12);
            setcookie("password",$password,time()+3600*24*30*12);
            header("location:second.php");
        }
    }
    
  
  echo "Incorrect Users";


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
    <h2>Log In</h2>
    <form method="post" >
        Email: <input type="text" name="email">
        Password: <input type="text" name="password">
        <input type="submit" name="sub" value="SUBMIT">
    </form>
</body>
</html>