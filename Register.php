<?php

include('Cap.php');

error_reporting(0);

// input fields 
$name = input_field($_POST["name"]);
$email = input_field($_POST["email"]);
$username = input_field($_POST["username"]);
$password = input_field($_POST["password"]);
$age = input_field($_POST["age"]);
$gender = input_field($_POST["gender"]);

$tmp = $_FILES["image"]["tmp_name"];
$fname = $_FILES["image"]["name"];

// error variables 
$nameErr = $emailErr = $usernameErr = $passwordErr = $imageErr = $ageErr = $genderErr = $capErr = "";

// validation
if (isset($_POST["sub"])) {

    // name validation 
    if (empty($name)) {
        $nameErr = "Name is required.";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $nameErr = "Only Characters and white spaces are allowed.";
    } 

    // email validation 
    if (empty($email)) {
        $emailErr = "Email Address is required.";
    } else if (!preg_match("/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/", $email)) {
        $emailErr = "Invalid Email Address.";
    }

    // username validation 
    if (empty($username)) {
        $usernameErr = "Username is required.";
    } else if (!preg_match("/^[a-z0-9_]+$/", $username)) {
        $usernameErr = "Only Small Characters, Numbers and \"_\" are allowed.";
    }

    // password validation 
    if (empty($password)) {
        $passwordErr = "Password is required.";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $password)) {
        $passwordErr = "Length of password should be between 4, 16 characters.";
    }

    // age validation 
    if (empty($age)) {
        $ageErr = "Please Enter your Age.";
    }

    // gender validation 
    if (empty($gender)) {
        $genderErr = "Please Select your Gender.";
    }

    $ext = pathinfo($fname, PATHINFO_EXTENSION);
    $fn =  "attach-" . rand() . "-" . time() . "." .$ext;

    if ($nameErr === "" && $emailErr === "" && $usernameErr === "" && $passwordErr  === "" && $ageErr ==  "" && $imageErr === ""  && $genderErr === "") 
    {
        if($_POST['cap']===$_POST['capsum']){
            if (is_dir("users/$email")) {
                $emailErr = "Email id already registered.";
            } 
            else if ($ext == "jpg" || $ext == "png" || $ext == "jpeg"){
                mkdir("users/$email");
              // mkdir("user/$username");
                $details = fopen("users/$email/"."details.txt","w");
                fwrite($details, $username . "\n" . $password . "\n" . $name . "\n" . $age . "\n" . $gender . "\n" . $fn);
                move_uploaded_file($tmp, "users/$email/$fn");
                    //echo "<script>alert('User registered successfully')</script>";
                  header("location:Welcome.php?uid=$email");
                
            } 
            else {
                $imageErr = "Please Select image file png, jpg or jpeg";
            }
          }
        else{
          $capErr = "Wrong Answer";
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

    <title>New Users</title>
    
    
  </head>
  <body>
   <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Register</h1>
            </div>
      </div> 

      
              
  <!--Registration Form -->
      <section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.jpg');">
              <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                      <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                    

                      <form method="post" enctype="multipart/form-data">

                      <div class="form-outline mb-4">
                          <input type="email" id="email" class="form-control form-control-lg" name="email" />
                          <label class="form-label" for="email">Email</label>
                          <small id="err" class="form-text text-danger"><?php echo $emailErr; ?></small>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="username" class="form-control form-control-lg" name="username"/>
                          <label class="form-label" for="username">Username</label>
                          <small id="err" class="form-text text-danger"><?php echo $usernameErr; ?></small>
                        </div>

                        

                        <div class="form-outline mb-4">
                          <input type="password" id="password" class="form-control form-control-lg" name="password"/>
                          <label class="form-label" for="password">Password</label>
                          <small id="err" class="form-text text-danger"><?php echo $passwordErr; ?></small>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="name" class="form-control form-control-lg" name="name"/>
                          <label class="form-label" for="name">Name</label>
                          <small id="err" class="form-text text-danger"><?php echo $nameErr; ?></small>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="age" class="form-control form-control-lg" name="age"/>
                          <label class="form-label" for="age">Age</label>
                          <small id="err" class="form-text text-danger"><?php echo $ageErr; ?></small>
                        </div>

                        
                       
                        <div class="form-group col-md-6 col-sm-12">
                        <h5>Gender</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                       <small id="err" class="form-text text-danger"><?php echo $genderErr; ?></small>
                        </div>

                        <br>
                        <br>
                            
                        <div class="form-outline mb-4">
                          <input type="file" id="image" class="form-control form-control-lg" name="image"/>
                          <label class="form-label" for="image">Image</label>
                          <small id="err" class="form-text text-danger"><?php echo $imageErr; ?></small>
                        </div>

                        <div class="form-outline mb-4">
                        <label class="form-label" for="image">Captcha : <b><?php echo $pat; ?></b></label>
                          <input type="text" id="cap" class="form-control form-control-lg" name="cap"/>
                          <input type="hidden" id="cap" class="form-control form-control-lg" name="capsum" value="<?php echo $capsum; ?>"/>
                          
                          <small id="err" class="form-text text-danger"><?php echo $capErr; ?></small>
                        </div>

                        <div class="d-flex justify-content-center">
                          <input type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="SUBMIT" name="sub"></input>
                          
                        </div>

                        

                      </form>

                    </div>
                  </div>
                </div>
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