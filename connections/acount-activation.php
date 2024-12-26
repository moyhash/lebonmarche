<?php
  $pageTitle = 'Changer mot de pass'; // For the Title
  include "../config/connect.php";
  include "header.php";
  include 'part-logo.php';

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM users
        WHERE acount_activation = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

$sql = "UPDATE users
        SET acount_activation = NULL
        WHERE userid = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $user["userid"]);

$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon"  href="../assets/Sans titre.ico" />
  <title>Account Activation</title>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="container">
<br><br>
  <h3>Account Activation</h3>

  <p>Account activation successfully. You can now
  <a href="login.php">se connecter</a>
</p>

</body>

</html>

