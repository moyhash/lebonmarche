
<?php
  session_start();
  $pageTitle = 'Page de connection'; // For the Title
  include "../config/connect.php";
  include "./header.php";
  include 'part-logo.php';

  if(isset($_POST['login'])) {
    $name = $_POST['user'];
    //$pass = $_POST['password'];

     //$stmt = "SELECT * from users WHERE name = '$name' AND password = '$pass'";
    $stmt = "SELECT * from users WHERE name = '$name'";
    $result = mysqli_query($conn, $stmt);
    $user = mysqli_fetch_assoc($result);

    //$message = ""; // Filter Infos Before Send

    if($user && $user['acount_activation'] === null){
      if (!password_verify($_POST['password'], $user['password'])) {
        $message = 'Password is not correct';
      }
      if(password_verify($_POST['password'], $user['password'])){
        // session_regenerate_id();
        $_SESSION['ID'] = $user['userid']; // Create a Session ID
        header('Location: ../home'); // Redirect to this dashboard page
        exit();
      }
    }else {
      /*echo '<br><br>';
      echo '<div class="container">';
      $theMsg = '<div class="alert alert-danger">Verifier votre compte..!<br>Si vous avez crée un compte il n\'est pas encore activé.</div>';
      // redirectHome($theMsg);
      redirectHome2($theMsg, 'back', 7);
      echo '</div>';*/
      $message = '<p class="mx-2 mb-3 mt-3">Verifier vos informations</p>';
    }
  }
?>


<div class="col-sm-12 col-md-9 m-auto px-3 py-3 mt-5">
  <form class="form-control login" action="login" method="POST">
    <h5 class="text-center">Se connecter au compte</h5>
    <input class="form-control" type="text" name="user" placeholder="username" value="<?= htmlspecialchars($_POST['user'] ?? "") ?>" />
    <div class="parent">
      <input id="myInput" class="form-control" type="password" name="password" placeholder="password" />
      <div id="passIcon" class="icon-eye-slash" onclick="myLogin()"></div>
      <!-- <p id="message" class="message">password not correct</p> -->
      <?php if (isset($message)) {
        echo '<font color="red">' . $message; '</font>';
      } ?>

    </div>
    
    <div class="d-grid">
      <input class="btn btn-primary btn-block" type="submit" name="login" value="Connecter">
    </div>
    <a class="mot-secret" href="forgot-password">Mot de pass oublié..?</a><br><br>
    <span>Vous n'avez pas encore de compte.?</span> <a href="signin?do=signin">&nbsp;Enregistrer vous ici.</a> 
  </form>

</div>
  