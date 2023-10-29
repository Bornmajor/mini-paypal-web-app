<?php

include 'functions.php';

$sess_id = $_SESSION['account_id'];
$query = "SELECT * FROM user_accounts WHERE account_id = '$sess_id'";
$select_bal = mysqli_query($connection,$query);
checkQuery($select_bal);
while($row = mysqli_fetch_assoc($select_bal)){
   $db_bal =  $row['balance'];

}
echo $db_bal;

?>