<?php
session_start();
$sid=$_SESSION['sid'];
if(empty($sid)){
  header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
<?php include('Nav.php'); ?>

<!-- Sidebar & Contentarea-->
<div class="row container">
  <div class="col-4 ">
  <?php include('Sidebar.php'); ?>

  </div>


  <div class="col-8 bg-dark text-white">
    <?php
    switch(@$_GET['con']){
      case 'changepass' : include('Changepass.php');
      break;

      case 'category' : include('Category.php');
      break;

      case 'orders' : include('Orders.php');
      break;
      
      case 'products' : include('Products.php');
      break;
      
      case 'feedback' : include('Feedback.php');
      break;
    }
    
    ?>

   

  </div>
</div>

</body>
</html>