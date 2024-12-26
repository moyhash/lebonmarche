<html lang="en">

<?php
  session_start();
  $pageTitle = 'Mot de pass oublié'; // For the Title
  include "../config/connect.php";
  include "./header.php";
  include './part-logo.php';
  ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

  <div class="container">
    <div class="text-white col-sm-12 col-md-9 px-3 py-3 mt-5 m-auto">
      <h5>Reset Your Password</h5>
      <form class="form-control py-4" action="send-password" method="POST">
        <input class="form-control" type="email" name="email" placeholder="Ecris ton email pour renitialiser ton mot de pss">
        <button type="submit" name="send" class="btn btn-secondary text-light">
          Resset Passwords <i class="fa-solid fa-paper-plane"></i>
        </button>
      </form>
    </div>
  </div>

</body>

</html>