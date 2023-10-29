<?php
//php mailer required
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;


// require 'vendor/autoload.php';

include 'connection.php';


function successMsg($message){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> 
  '.$message.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';


}
function failMsg($message){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
  '.$message.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
function escapeString($string){
    global  $connection;
   return mysqli_real_escape_string($connection,$string);
 
 }

 function checkQuery($result){
    global $connection;
    if($result){

    }else{
        die("Query failed".mysqli_error($connection));
    
    }  
}

function checkEmptyRow($result){
    global $connection;

$total_rows = mysqli_num_rows($result);

    if($total_rows == 0){
    echo '<div class="empty_list"> <span> Empty list</span> </div>';
    }
}

function createAccount(){
  global $connection;

  

if(isset($_POST['register_user'])){
  $user_mail = $_POST['user_mail'];
$username = $_POST['username'];
$pwd = $_POST['pwd'];

$user_mail = escapeString($user_mail);
$username = escapeString($username);
$pwd = escapeString($pwd);

 $user_mail = $_POST['user_mail'];
 $username = $_POST['username'];
 $pwd = $_POST['pwd'];

 $company_id = 'EB';
 $account_id = $company_id.uniqid();


// password encryption
$pwd = password_hash($pwd,PASSWORD_BCRYPT,array('cost' => 12));
 
//check email exist

  $query = "SELECT * FROM user_accounts WHERE user_mail = '$user_mail'"; 
  $select_mail = mysqli_query($connection,$query);
  checkQuery($select_mail);
  while($row = mysqli_fetch_assoc($select_mail)){
      $db_mail= $row['user_mail'];
  
  }
  
  if(!isset($db_mail)){

       $query = "INSERT INTO user_accounts(account_id,username,user_mail,pwd,balance)VALUES('$account_id','$username','$user_mail','$pwd',0)";
 $insert_account = mysqli_query($connection,$query);
 if($insert_account){
  successMsg("Account created successfully");

 }
  }else{
      failMsg('This email exist, try another one');
  }


}



}

function loginAccount(){
  global $connection;

  if(isset($_POST['login_user'])){



  $account_id = $_POST['account_id'];
  $pwd = $_POST['pwd'];

 $account_id = escapeString($account_id);
 $pwd = escapeString($pwd);

 $query = "SELECT * FROM user_accounts WHERE account_id = '$account_id'";
 $select_account = mysqli_query($connection,$query);

 checkQuery($select_account);
 while($row = mysqli_fetch_assoc($select_account)){
 $db_account_id = $row['account_id'];
 $db_pwd = $row['pwd'];



 }
 if(isset($db_account_id)){

 if(password_verify($pwd,$db_pwd)){
  $_SESSION['account_id'] = $db_account_id;

      
                  //cookie store
                  $cookie_name = 'ebanking';
                  //extract first two letter

                  $id = $_SESSION['account_id'];
                  $bank_id = substr($id,2);
                  
                  $cookie_value =  $bank_id;
                  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

  successMsg('Login successfully!!Redirecting...');
      //redirect main page
      echo "
      <script type='text/javascript'>
      window.setTimeout(function() {
          window.location = 'index.php?include=account';
      }, 2000);
      </script>
      ";

 }else{
  failMsg('Password is incorrect');
 } 

 }else{
  failMsg('Wrong bank account address');
 }

}

}


function checkUsrSession(){
  global  $connection;
  if(!isset($_SESSION['account_id'])){
      header("Location: index.php");

  }

}
function displayUsername(){
  global $connection;

   if(isset($_SESSION['account_id'])){
    $sess_id = $_SESSION['account_id'];

      $query = "SELECT * FROM user_accounts WHERE account_id = '$sess_id'";
  $select_username = mysqli_query($connection,$query);
  checkQuery($select_username);

  while($row = mysqli_fetch_assoc($select_username)){
   $username = $row['username'];

  }
  echo $username;
}
   }
   
 
function viewTransactions(){
  global $connection;

  $sess_id = $_SESSION['account_id'];
$query = "SELECT * FROM transactions WHERE sender_acc = '$sess_id' || receiver_acc = '$sess_id' ORDER BY trans_id DESC";
$select_trans = mysqli_query($connection,$query);
checkQuery($select_trans);
checkEmptyRow($select_trans);

while($row = mysqli_fetch_assoc($select_trans)){
  $sender_acc  = $row['sender_acc'];
  $receiver_acc = $row['receiver_acc'];
  $trans_amount = $row['trans_amount'];
  $trans_date = $row['trans_date'];

if(isset($sender_acc)){
?>

<!--trans_divs-->
<div class='trans_div'>

<div class="user_profile">
    <img src="images/profile.png" alt="">
</div>

<div class="username_date"><!--username_date-->
<?php
//get receiver username
//get sender username
$query ="SELECT * FROM user_accounts WHERE account_id = '$receiver_acc'";
$select_receiver = mysqli_query($connection,$query);
checkQuery($select_receiver);
while($row = mysqli_fetch_assoc($select_receiver)){
$db_account_id = $row['account_id'];
$receiver =  $row['username'];

}



//get sender username
$query ="SELECT * FROM user_accounts WHERE account_id = '$sender_acc'";
$select_sender= mysqli_query($connection,$query);
checkQuery($select_sender);
while($row = mysqli_fetch_assoc($select_sender)){
$db_account_id = $row['account_id'];
$username =  $row['username'];

}
if($db_account_id == $sess_id){//if account is yours
?>
<div class="username"><span><?php echo 'Sent to '.$receiver; ?></span></div>

<?php
}else{
?>
<div class="username"><span><?php echo 'Receiver from '.$username ?></span></div>
<?php
}

?>



<div class="trans_date"><span><?php echo $trans_date ?></span></div>

</div><!--username_date-->

<div class="trans_amount"><!--trans_amount-->
<span >Ksh <?php echo $trans_amount; ?></span>
</div><!--trans_amount-->

</div>
<!--trans_divs-->

<?php
 }
 }
}

?>