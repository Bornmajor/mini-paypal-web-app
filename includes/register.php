
<section>

<div class="section_one"><!--section_one-->
<img class='illustration_img' src="images/online-payment.png" alt="">
</div><!--section_one-->

<div class="section_two"><!--section_two-->

    <form  id='form_login' action="" method="post" >
    <div class="mb-3"><?php createAccount(); ?></div>
    <div class="mb-3"><div class="title">Account registration</div></div>

    <div id="email_feedback" style='margin-bottom:10px;'></div>
  <div class="mb-3">
    <input type="email" name="user_mail" id="email" placeholder='Email' class="form-control" required>
  </div>
    <div class="mb-3">
         <input type="text" name="username" id="username" placeholder='Username' class="form-control" required>
    </div>
  
    <div class="mb-3">
         <input type="password" name="pwd" id="pwd" placeholder='Password' class="form-control" required>
    </div> 
    <div id="pwd_feedback" style='margin-bottom:10px;color:red;display:none;'>Passwords don't match</div>
    <div class="mb-3">
         <input type="password" name="pwd-repeat" id="pwd-repeat" placeholder='Repeat password' class="form-control" required>
    </div> 
 
    <div class="mb-3">
        <input type="submit" name='register_user' class='btn btn-primary' value="Registration">
    </div>
    <div class="mb-3">
        <a class='links' href="?include=login">Already have an account</a>
    </div>
    </form>

</div><!--section_two-->

</section>
<script>
    $(document).ready(function(){
    $('#form_login').submit(function(e){
      

        let pwd = $('#pwd').val();
        let pwd_repeat = $('#pwd-repeat').val();

        if(pwd !== pwd_repeat){
           
        $('#pwd_feedback').slideDown();
        e.preventDefault();
        }else{
            $('#pwd_feedback').slideUp();
        }


      
        

    });
    $('#pwd-repeat').keyup(function(){
        
        let pwd = $('#pwd').val();
        let pwd_repeat = $('#pwd-repeat').val();

        if(pwd !== pwd_repeat){
        
        $('#pwd_feedback').slideDown();
        }else{
            $('#pwd_feedback').slideUp();
        }

    })
    $('#email').keyup(function(){
        //check email exist
        let user_mail = $(this).val();
        $.post("includes/check_mail.php",{user_mail:user_mail},function(data){
            $('#email_feedback').html(data).slideDown();

        })
    

    })
})//document

</script>


