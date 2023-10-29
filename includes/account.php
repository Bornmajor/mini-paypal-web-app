<?php

checkUsrSession();
$sess_id = $_SESSION['account_id'];
$query = "SELECT * FROM user_accounts WHERE account_id = '$sess_id'";
$select_balance = mysqli_query($connection,$query);
checkQuery($select_balance);

while($row = mysqli_fetch_assoc($select_balance)){
   $balance = $row['balance'];

}
?>
<div class="send_bal"><!--send_bal-->


<div class="send_money"><!--send_money-->

<form id='form_send_money' action="" method="post">
    <div class="title">Send money</div>
    <div id="feedback_withdraw"></div>
    <div class="mb-3">
    <input type="text" name="bank_acc" id='bank_acc' placeholder='Enter receiver bank number' class='form-control' required>
</div>
<div class="mb-3">
    <input type="number" name="withdraw" id="withdraw" min="1" placeholder='Enter amount' class='form-control' required>
</div>
<div class="mb-3">
    <input type="submit" name='send_money' value="Send Money" class='btn btn-primary'>
</div>

</form>

</div><!--send_money-->



<div class="balance"><!--balance-->
<div class="title">Current balance</div>

<span>Ksh</span>
<div class="amount_val">0</div>

</div><!--balance-->



</div><!--send_bal-->

<div class="transcations"><!--transcations-->
<div style='margin:15px;' class="title">Transcations</div>

<div class="view_transcations"></div>





</div><!--transcations-->

<script>
    $('#bank_acc').focusout(function(){
        let bank_acc = $(this).val();
        // alert(bank_acc);
        $.post("includes/check_bank.php",{bank_acc:bank_acc},function(data){
            $('#feedback_withdraw').html(data);

        })
    });
   
    function updateBalance(){
        $.ajax({
           url :'includes/update_balance.php',
        type: 'POST',
        success:function(show_bal){
                if(!show_bal.error){
                    $('.amount_val').html(show_bal);
                }
               

            } 
    })    
    }
    function updateTransactions(){
             $.ajax({
           url :'includes/view_transactions.php',
        type: 'POST',
        success:function(show_trans){
                if(!show_trans.error){
                    $('.view_transcations').html(show_trans);
                }
               

            } 
    })    
    } 
    

 updateBalance();
 updateTransactions();
  

    $('#form_send_money').submit(function(e){
        e.preventDefault();

        let postData = $(this).serialize();

        let confirmalert = confirm("You are about to send money,Click OK to proceed");
     
        if (confirmalert == true){

        $.post("includes/check_balance.php",postData,function(data){
            $('#feedback_withdraw').html(data);
            updateBalance();
            updateTransactions();
            });


        }
    
      
    



      
      

        
    })
    
</script>