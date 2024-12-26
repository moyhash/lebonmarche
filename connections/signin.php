<?php 
  // session_start();
$pageTitle = 'Page d\'enregistrement'; // For the Title
include "../config/connect.php";
include "header.php";
include 'part-logo.php';


$do = isset($_GET['do']); // Request Viens De Login Page

if($do == "signin"){ ?>

  <div class="col-sm-12 col-md-9 m-auto px-3 py-3 mt-5">
    <form class="form-control login" action="./Process-signup" method="POST">
      <h5 class="text-center">Créer un nouveau compte</h5>
      
      <div class="papa">
        <input id="userName" class="form-control" type="text" name="name" placeholder="Username" autocomplete="off" />
        <div id="usericon" class="icon-check_circle"></div>
        <p id="usermessage" class="message">usesr name must be > 8 caractere</p>
      </div>
      <div class="papa">
        <input id="userEmail" class="form-control" type="email" name="email" placeholder="Adresse Email" autocomplete="new-password" />
        <div id="emailIcon" class="icon-check_circle"></div>
        <p id="mailmessage" class="message">this is not a correct email</p>
      </div>
      <div class="papa">
        <input id="userPass" class="form-control userPasswd1" type="password" name="pass1" placeholder="Password" autocomplete="new-password" />
        <div id="eyeIcon" class="icon-eye-slash" onclick="mySignup()"></div>
        <div id="passIcon" class="icon-check_circle"></div>
        <p id="passMessage" class="message">password must be letter with AZ 0/9 & {$/@} </p>
      </div>
      <div class="papa">
        <input id="rePasswd" class="form-control userPasswd" type="password" name="pass2" placeholder="Password" autocomplete="off" />
        <div id="eyeIcon2" class="icon-eye-slash" onclick="mySignup2()"></div>
        <div id="repassIcon" class="icon-check_circle"></div>
        <p id="repassMessage" class="message">password not correct</p>
      </div>
      <div class="d-grid">
        <input id="register" class="btn btn-primary btn-block registerbtn" type="submit" value="Enregistrer" disabled>
      </div>
      <span>Vous avez déjà un compte? </span> <a href="./login">&nbsp;&nbsp; Se Connecter.</a> 
    </form>
  </div>

<?php }  else {
  echo '<div class="container">';
  //echo '<div class="alert alert-danger">Found no Request</div>';
  $theMsg = '<div class="alert alert-danger">Requested Error fo no Droit </div>';
  redirectHome($theMsg);
  echo '</div>';
} ?>
