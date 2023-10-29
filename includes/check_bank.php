<?php
include 'functions.php';

if(isset($_POST['bank_acc'])){
   $bank_acc = $_POST['bank_acc'];
   $bank_acc = escapeString($bank_acc);

   $query = "SELECT * FROM user_accounts WHERE account_id = '$bank_acc'";
   $select_account = mysqli_query($connection,$query);
   checkQuery($select_account);
   while($row = mysqli_fetch_assoc($select_account)){
    $db_bank = $row['account_id'];

   }
   if(!isset($db_bank)){
  
        echo '<div style="color:red;">Bank account number is invalid, try again</div>';
    
   }
}

?>