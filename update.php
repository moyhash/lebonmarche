<?php
include "config/connect.php";

if (isset($_GET['anonce_id']) || is_numeric($_GET['anonce_id'])) {
  // die('Invalid or missing annonce ID');
  $id = intval($_GET['anonce_id']);
}

if (isset($_POST['update'])) {

  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $sub_title = mysqli_real_escape_string($conn, $_POST['sub-title']);
  $desc = mysqli_real_escape_string($conn, $_POST['description']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
  $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);

  $formError = array();

  if (empty($title)) {
    $formError[] = 'Titre cant be Empty';
  }
  if (empty($sub_title)) {
    $formError[] = 'SubTitle cant be Empty';
  }
  if (empty($desc)) {
    $formError[] = 'Description cant be Empty';
  }
  if (empty($price)) {
    $formError[] = 'Price cant be Empty';
  }
  if (empty($adresse)) {
    $formError[] = 'Ye Adresse cant be Empty';
  }
  if ($status == 0) {
    $formError[] = 'Status cant be Empty';
  }

  foreach ($formError as $error) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
    //redirectHome2($theMs2, 'back', 7);
  }

  if (empty($formError)) {

    $query = "UPDATE annonces SET title='$title', sub_title='$sub_title', description='$desc',
      adresse='$adresse', status='$status', price='$price' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $message = "Votre article a bien eté modifié...";
      // header("Location: edition?annonce_id=$id");
    } else {
      $message = "Woops Un problem est survenu... ";
    }

  }
  mysqli_close($conn);

} else {
  $message = "Veuillez remplir tous les champs...";
}