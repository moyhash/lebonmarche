<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

$formErrors = array();

if ($user === null) {
  die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
  die("token has expired");
}

if (strlen($_POST["pass1"]) < 8) {
  die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["pass1"])) {
  die("Password must contain at least one small letter");
}

if (!preg_match("/[A-Z]/", $_POST["pass1"])) {
  die("Password must contain at least one capital letter");
}

if (!preg_match("/[0-9]/", $_POST["pass1"])) {
  die("Password must contain at least one number");
}

if (!preg_match("/[$%&@#?]/", $_POST["pass1"])) {
  die("Password must contain at least one special characters");
}

if ($_POST["pass1"] !== $_POST["pass2"]) {
  die("Mot de pass doivent etre Identique");
}

$password_hash = password_hash($_POST["pass1"], PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE userid = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["userid"]);

$stmt->execute();

echo '<div class="col-sm-12 col-md-9 m-auto bg-success text-center text-white fs-5 fw-medium p-3 mb-2 mt-1 shadow rounded">
Password updated. You can now login.</div>';