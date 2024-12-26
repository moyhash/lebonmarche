<?php

$mysqli = require __DIR__ . "/database.php";
// error_reporting(0);

$cle = rand(1000000, 9000000);
$pass_hash = password_hash($_POST['pass1'], PASSWORD_DEFAULT);

$activation_token = bin2hex(random_bytes(16));
$activation_token_hash = hash("sha256", $activation_token);

$query = "INSERT INTO users (name, password, email, acount_activation) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($query)) {
  die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss", $_POST['name'], $pass_hash, $_POST['email'], $activation_token_hash);
if ($stmt->execute()) {

  $mail = require __DIR__ ."/mailler.php";

  $mail->setFrom('djoumoihassan59@gmail.com');
  $mail->addAddress($_POST['email']);
  $mail->Subject = ("Acount Activation");
  $mail->Body = <<<END
   Suivre ce lien <a href="http://localhost:8055/lebonmarche/connections/acount-activation.php?token=$activation_token">
   Activate your Account</a>
  END;

  try{
    $mail->Send(); 
  }catch(Exception $error){
    echo "Could not send . Mailer error: {$mail->ErrorInfo}";
    exit;
  }  

  header("Location: signup-success.html");
  exit; // fortement conseillé de quité 
} 
else {
  if ($mysqli->errno === 1062) {
    die("Cette email existe deja");
  } else {
    die($mysqli->error . " " . $mysqli->errno);
  }
}

/*
print_r($_POST);
var_dump($pass_hash);
*/