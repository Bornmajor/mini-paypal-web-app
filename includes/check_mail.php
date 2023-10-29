<?php
include 'functions.php';

$user_mail = $_POST['user_mail'];
$user_mail  = escapeString($user_mail);

   if(isset($user_mail)){
$query = "SELECT * FROM user_accounts WHERE user_mail = '$user_mail'"; 
$select_mail = mysqli_query($connection,$query);
checkQuery($select_mail);
while($row = mysqli_fetch_assoc($select_mail)){
    $db_mail= $row['user_mail'];

}

if(isset($db_mail)){
    if($user_mail == $db_mail){
        echo '<span style="color:red;">This email address is not available try another one. </span>';
    }
}else{
    echo '<span style="color:green;">This email address is available. </span>';
}




}
?>