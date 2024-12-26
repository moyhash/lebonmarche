<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$pageTitle = 'Envoyer un message'; // For the Title
include "../config/connect.php";
include "header.php";
include 'part-logo.php';

if (!isset($_SESSION['ID'])) {
  header('Location: login.php');
}

if (isset($_GET["userid"]) and !empty($_GET["userid"])) {
  $userid = htmlspecialchars($_GET['userid']);

  $sql = "SELECT * FROM users WHERE userid = $userid";
  $result = mysqli_query($conn, $sql);
}

?>

<div class="container-fluid">
  <div class="unmodel">
    <!-- Here show an important message -->
    <p>
      Wewe mdrou wandzawo wou houle, renga ze hadhari za haho <br>
      karitsi ma dhoimana na hayina zidjo woudjiri harimwa <br>
      ye biyachara ya haho. haswa hawsa ndawe mhoula
    </p>
    <div id="close1">&#10006;</div>
  </div>
</div>

<br><br>
<h3 class="text-primary text-center fw-medium">Envoyer un message a l'annonceur</h3>
<?php
if ($user = mysqli_fetch_assoc($result)) {
  echo "<div class='container'>
    <div class='bg-dark text-white m-auto rounded col-12 col-md-8 p-4 mb-4'>
      Pour envoyer un message et demander plus des informations sur cette annonce<br> 
      remplir le formulaire en bas et ceci est l'adresse de l'annonceur : " . htmlspecialchars($user['email'], 
      ENT_QUOTES, 'UTF-8') . "</div>
    </div>";
} 
?>


<div class="container">
  <div class="m-auto col-12 col-md-8 mb-4">
    <form class="form-horizontal">
      <input type="text" class="form-control" placeholder="un titre">

      <textarea class="form-control form-groupe mb-2" rows="5" cols="73" id="message" name="text" placeholder="Ecrire un message"></textarea>
      <button type="submit" class="btn btn-primary mb-4">Send Message</button>
    </form>
  </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/rizalcss@2.1.0/js/components.min.js"></script>
</body>

</html>