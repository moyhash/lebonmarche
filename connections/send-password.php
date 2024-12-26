<!-- https://www.youtube.com/watch?v=5L9UhOnuos0&ab_channel=DaveHollingworth -->
<!-- https://www.youtube.com/watch?v=R9bfts9ZFjs&t=2s&ab_channel=DaveHollingworth -->
<?php

include "./header.php";
include './part-logo.php';

$email = $_POST['email'] ?? null;


$token = bin2hex(random_bytes(16));
$token_hash = hash(algo: "sha256",  data: $token);

$expirer = date("Y-m-d H:i:s", time() + 60 * 30); //24h

$mysqli = require __DIR__ . "/database.php";

$sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sss', $token_hash, $expirer, $email);

if ($stmt->execute() && $mysqli->affected_rows > 0) {
  $mail = require __DIR__ . "/mailler.php";

  $mail->setFrom('djoumoihassan59@gmail.com');
  $mail->addAddress($email);
  $mail->Subject = "Password Reset";
  $mail->Body = <<<END
    <div class="container">
      <h1 class="text-primary text-center font-bold">Message from Ogicas Group</h1>
      <p class="text-success">Pour Renitialiser votre mot de passe suivre ce lien 
        <a href="http://localhost:8055/lebonmarche/connections/reset-password.php?token=$token">Renitialiser votre Password</a>
        Nouvelle Mot de Passe. 
      </p>
    </div>
    END;

  try {
    $mail->Send();
    echo '<div class="container col-sm-12 col-md-8 mt-5">';
    echo '<div class="alert alert-success">Un message vient d\'être envoyé à votre adresse email.<br>
        Vérifiez votre messagerie et suivez le lien pour changer votre mot de passe.</div>';
    echo '</div>';
  } catch (Exception $error) {
    echo "Could not send email. Mailer error: " . htmlspecialchars($mail->ErrorInfo, ENT_QUOTES, 'UTF-8');
  }
} else {
  echo '<div class="alert alert-danger">Aucun utilisateur trouvé avec cet email ou échec de mise à jour du token.</div>';
}
?>