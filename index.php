<?php include 'includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-banking</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">  
    <link rel="stylesheet" href="css/style.css">  
    <script src="js/jquery-3.6.3.min.js"></script>
  
</head>
<body>
<!--navbar-->
<?php include 'includes/navbar.php'; ?>
<!--navbar-->

<?php
if(isset($_GET['include'])){
    $source = $_GET['include'];

}else{
    $source = '';
}
switch($source){
    case 'registration';
    include('includes/register.php'); 
    break;
    case 'account';
    include('includes/account.php');
    break;
    case 'profile';
    include('includes/profile.php');
    break;
    case 'logout';
    include('includes/logout.php');
    break;
    default:
    include('includes/login.php');
}
?>
    


<!--js-->
<script src="js/all.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/popper.min.js"></script>
<!--js-->

<footer>
    E-BANKING
</footer>
</body>
</html>