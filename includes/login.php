<?php
if(isset($_COOKIE['ebanking'])){
   $bk =  'EB';
   $_SESSION['account_id'] = $bk.$_COOKIE['ebanking'];
   
//    echo $_SESSION['account_id'];


}
if(isset($_SESSION['account_id'])){
  header('index.php?include=account');  
}


?>
<section>

<div class="section_one"><!--section_one-->
<img class='illustration_img' src="images/online-payment.png" alt="">
</div><!--section_one-->

<div class="section_two"><!--section_two-->

    <form  id='form_login' action="" method="post">
    <div class="mb-3"><?php loginAccount(); ?></div>
    <div class="mb-3"><div class="title">Account Login</div></div>

    <div class="mb-3">
         <input type="text" name="account_id" id="" placeholder='Account Number' class="form-control" required>
    </div>
    <div class="mb-3">
         <input type="password" name="pwd" id="" placeholder='Password' class="form-control" required>
    </div> 
    <div class="mb-3">
        <input type="submit" name='login_user' class='btn btn-primary' value="Login">
    </div>
    <div class="mb-3">
        <a class='links' href="?include=registration">Need an account?</a>
    </div>
    </form>

</div><!--section_two-->

</section>
