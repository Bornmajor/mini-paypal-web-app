<?php
include 'functions.php';
$withdraw = $_POST['withdraw'];

$withdraw = escapeString($withdraw);

$sess_id = $_SESSION['account_id'];
if(isset($sess_id)){
$query = "SELECT * FROM  user_accounts WHERE account_id = '$sess_id'";
$select_account = mysqli_query($connection,$query);
checkQuery($select_account);
while($row = mysqli_fetch_assoc($select_account)){
    $db_bal = $row['balance'];

}
//check  withdrawal
if($withdraw < $db_bal){

//check valid account
$bank_acc = $_POST['bank_acc'];
$bank_acc = escapeString($bank_acc);

$query = "SELECT * FROM user_accounts WHERE account_id = '$bank_acc'";
$select_account = mysqli_query($connection,$query);
checkQuery($select_account);
while($row = mysqli_fetch_assoc($select_account)){
 $db_bank = $row['account_id'];
 $receiver_bal = $row['balance'];

}
if(!isset($db_bank)){
    failMsg('Bank account number is invalid, try again');
 
}else if($db_bank == $sess_id){
     failMsg('You cannot send money to yourself');

}else{
//valid account
$cur_bal = $db_bal - $withdraw;

//deduce amount
$query = "UPDATE user_accounts SET balance = '$cur_bal' WHERE account_id = '$sess_id'";
$deduct_query = mysqli_query($connection,$query);
// checkQuery($deduct_query);
if($deduct_query){
    //update receiver account
   
   $receivable_amount = $withdraw + $receiver_bal;
    $query = "UPDATE user_accounts SET balance = '$receivable_amount' WHERE account_id = '$bank_acc'";
    $update_receiver = mysqli_query($connection,$query);
    if($update_receiver){
        //create transcations
        //get date
        $trans_date = date('Y-m-d');

        $query = "INSERT INTO transactions(sender_acc,receiver_acc,trans_amount,trans_date)VALUES('$sess_id','$bank_acc',$withdraw,'$trans_date')";
        $trans_query = mysqli_query($connection,$query);
        if($trans_query){
            successMsg('Transaction was successful');
        }
    }
}


}

 


}else{
     //check if widthdraw is less than balance
    failMsg('You have insuffficent balance for this transaction'); 

}


}

?>