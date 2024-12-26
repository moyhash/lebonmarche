<?php
session_start();
include "../config/connect.php";
include "header.php";
include 'part-logo.php';


if (!isset($_SESSION['ID'])) {
  header('Location: index');
}
// Select image to Delete

if (isset($_GET["anonce_id"]) and !empty($_GET["anonce_id"]) && isset($_GET["image_id"]) && !empty($_GET["image_id"])) {
  $anonce_id = intval($_GET['anonce_id']);
  $img_id = intval($_GET['image_id']);

  // This $query can delete one Image "Id is one"
  // $query = "SELECT image_url FROM annonces_images WHERE img_id = $del_id"; 

  $query = "SELECT * FROM annonces_images WHERE annonce_id = $anonce_id";
  $result = mysqli_query($conn, $query);
  $image_count = mysqli_num_rows($result);

  // Code to unlink(delete) image from the folder
  if ($image_count <= 1) {
    echo 'Message: Vous ne pouvez pas supprimer cette image, il doit rester au moins une image.';
  } else {

    $image_to_delete = null;
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['img_id'] == $img_id) {
        $image_to_delete = $row;
        break;
      }
    }
    if ($image_to_delete) {
      $file_path = "../img/" . $image_to_delete['image_url'];

      // Delete the image file from the folder
      if (!empty($image_to_delete['image_url']) && file_exists($file_path)) {
        if (unlink($file_path)) {
          // Delete the database record for the specific image
          $delete_query = "DELETE FROM annonces_images WHERE img_id = $img_id";
          $delete_stmt = mysqli_query($conn, $delete_query);

          if ($delete_stmt) {
            echo "Image supprimée avec succès.";
          } else {
            echo "Erreur lors de la suppression de l'enregistrement de l'image dans la base de données.";
          }
        } else {
          echo "Erreur lors de la suppression de l'image du dossier.";
        }
      } else {
        echo "Le fichier d'image n'existe pas ou est introuvable.";
      }
    } else {
      echo "Image introuvable pour l'ID spécifié.";
    }
  }
} else {
  echo "Requête invalide. Paramètres manquants.";
}



/*if ($result) {
   echo "<div class='container text-success fw-bold mb-3'>
        Image deleted successfully.</div>";
} else {

}*/


/*echo '<br><br>';
echo '<div class="container">';
$theMsg = "<div class='alert alert-danger'>voila l'image . $image_name . est supprimé</div>";
redirectHome($theMsg);
echo '</div>';*/
