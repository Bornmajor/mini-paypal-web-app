
<nav class="navbar sticky-top navbar-expand-lg" style="background-color: rgb(220, 145, 7);" >
  <div class="container-fluid">
    <a class="navbar-brand " href="index.php">E-banking</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul  class="navbar-nav me-5  mb-2 mb-lg-0">
    <li class="nav-item ">
          <a class="nav-link" style='cursor:pointer;' href='index.php' >Homepage</a>
        </li>
        <?php
        if(!isset($_SESSION['account_id'])){
         echo '<li class="nav-item">
          <a class="nav-link"  href="index.php?include=login">Login</a>
        </li>';
        }
        ?>
        

        <li class="nav-item">
          <a class="nav-link" href="index.php?include=registration">Create account</a>
        </li>
        
      
        <li class="nav-item">
          <a class="nav-link" href="#"><?php  displayUsername(); ?></a>
        </li>
      
        <?php
        if(isset($_SESSION['account_id'])){
         echo '<li class="nav-item">
          <a class="nav-link"  href="index.php?include=logout">Logout</a>
        </li>';
        }
        ?>

        <!-- <li class="nav-item">
          <a class="nav-link" href="index.php?include=profile">Profile</a>
        </li> -->
      
     
   
     
</ul>


    </div>
  </div>
</nav>