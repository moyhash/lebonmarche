<?php
session_start();
include "../config/connect.php";
include "header.php";
include 'part-logo.php';

if (!isset($_SESSION['ID'])) {
  header('Location: index');
}
// Select image to Delete
if (isset($_GET['anonce_id']) and !empty($_GET['anonce_id'])) {
  $anonce_id = intval($_GET['anonce_id']);

  $query = "SELECT image_url FROM annonces_images WHERE annonce_id = $anonce_id";
  $select = mysqli_query($conn, $query);
  
  if ($select) {
    // Step 2: Delete each image file from the folder
    while ($row = mysqli_fetch_assoc($select)) {
      $image_name = $row['image_url'];
      if (file_exists("../img/" . $image_name)) {
        unlink("../img/" . $image_name);
      }
    }

    // Step 3: Delete image references from the database
    $delete_images_query = "DELETE FROM annonces_images WHERE annonce_id = $anonce_id";
    $delete_images = mysqli_query($conn, $delete_images_query);

    if ($delete_images) {
      // Step 4: Delete the annonce itself
      $delete_annonce_query = "DELETE FROM annonces WHERE id = $anonce_id";
      $deleted_annonce = mysqli_query($conn, $delete_annonce_query);

      if ($deleted_annonce) {
        // Success: Redirect to home
        header("location: ../home");
        exit();
      } else {
        echo "Error deleting the annonce.";
      }
    } else {
      echo "Error deleting image references from the database.";
    }
  } else {
    echo "Error fetching images for the given annonce_id.";
  }
} else {
  echo "Invalid or missing annonce_id.";
}

?>

<script type="text/javascript">
  function ConfirmDelete() {
    if (confirm("Delete Account?"))
      location.href = '../home';
  }