<?php


session_start();


$_SESSION['account_id'] = null;

setcookie("ebanking", "", time() - 3600,"/");

header("Location:index.php");


?>