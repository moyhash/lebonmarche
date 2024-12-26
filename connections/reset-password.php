<?php
  $pageTitle = 'Changer mot de pass'; // For the Title
  include "../config/connect.php";
  include "header.php";
  include 'part-logo.php';

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
  die('<div class="col-sm-12 col-md-9 m-auto bg-danger text-center text-white fs-5 fw-medium p-3 mb-2 mt-1 shadow rounded">
    Le code de renitialisation est expiré<br> Veuiller ressayer a nouveau</div>');
}

echo '<div class="col-sm-12 col-md-9 m-auto bg-success text-center text-white fs-5 fw-medium p-3 mb-2 mt-1 shadow rounded">
   Le code de renitialisation est toujours valid<br> Vou pouvez continuer</div>';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password Form</title>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
</head>

<body>
<br><br>

  <div class="container col-sm-12 col-md-9">
    <form class="form-control" action="process-reset-password" method="POST">
      <h5 class="text-center">Reset Your Password</h5>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

      <div class="reset-pass">
        <input id="pass1" class="form-control" type="password" name="pass1" placeholder="New password">
        <div id="eyeIcon3" class="icon-eye-slash" onclick="resetPass1()"></div>
      </div>
      <div class="reset-pass">
        <input id="pass2" class="form-control" type="password" name="pass2" placeholder="Confirm password">
        <div id="eyeIcon4" class="icon-eye-slash" onclick="resetPass2()"></div>
      </div>
      <button type="submit" name="send" class="btn btn-secondary text-light">
        Resset Password <i class="fa-solid fa-paper-plane primary-button-icon color_white"></i>
      </button>
    </form>
  </div>

</body>

</html>

