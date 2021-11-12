<?php

error_reporting(0);

// input fields 
  $email=input_field($_POST['email']);
  
  $password=input_field($_POST['password']);
  

  $tmp=$_FILES['image']['tmp_name'];
  $fname=$_FILES['image']['name'];
 

  // error variables 
$emailErr = $passwordErr = "";

if(isset($_POST['login'])){
   
  

    // email validation 
    if (empty($email)) {
        $emailErr = "Email Address is required.";
    } else if (!preg_match("/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/", $email)) {
        $emailErr = "Invalid Email Address.";
    }

    
    // password validation 
    if (empty($password)) {
        $passwordErr = "Password is required.";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $password)) {
        $passwordErr = "Length of password should be between 4, 16 characters.";
    }

    


   

    if ($emailErr == "" && $passwordErr  == "" ) {
      if(is_dir("users/".$email)){
        $fo=fopen("users/".$email."/details.txt","r");
        fgets($fo);
        $filepass=trim(fgets($fo));
        if($password==$filepass){
           session_start();
           $_SESSION['sid']=$email;
           if(!empty($_POST['remember'])){
             setcookie('email',$email,time()+3600*24);
             setcookie('password',$password,time()+3600*24);
           }
           header("location:Dashboard.php");
           //echo "<script>alert('Login Successful.')</script>";
        }
        else{
              $passwordErr = "Incorrect  password.";
              //echo "<script>alert('Enter correct  password.')</script>";
                 
            }
       
           
      }
      else{
        $emailErr = "Email not registered.";
        // echo "<script>alert('Email not registered.')</script>";
      }
    
    }
  
  
  
}

 // trim function 
function input_field($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Log In</title>
    <script>

      function cook(){
        if("<?php echo $_COOKIE['email']; ?>"!=undefined){
          if(document.getElementById("email").value=="<?php echo $_COOKIE['email']; ?>"){
            document.getElementById("password").value="<?php echo $_COOKIE['password']; ?>";
          }
          else{
            document.getElementById("password").value="";
          }
        }
      }
      </script>

    
  </head>
  <body>
   <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Log In</h1>
            </div>
      </div> 

      
              
      <section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">

        

        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form style="width: 23rem;" method="post">

           

            <div class="form-outline mb-4">
              <input type="email" id="email" onchange="cook()" class="form-control form-control-lg" name="email" />
              <label class="form-label" for="email">Email address</label>
              <small id="err" class="form-text text-danger"><?php echo $emailErr; ?></small>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="password" class="form-control form-control-lg" name="password"/>
              <label class="form-label" for="password">Password</label>
              <small id="err" class="form-text text-danger"><?php echo $passwordErr; ?></small>
            </div>

            <div class="pt-1 mb-4">
              <input class="" type="checkbox" name="remember" >&nbsp; Remember Me
            </div>

            <div class="pt-1 mb-4">
              <input class="btn btn-info btn-lg btn-block" type="submit" name="login" value="LOG IN">
            </div>

           

            
            <p>Don't have an account? <a href="Register.php" class="link-info">Register here</a></p>

          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/img3.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>
            

    
    
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>