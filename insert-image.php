<?php
$uploadDir = "img/";

if(isset($_GET["anonce_id"]) AND !empty($_GET["anonce_id"])){
  $id = htmlspecialchars($_GET['anonce_id']);
}

if(isset($_POST["insert"])) {

  $imgName = $_FILES['image']['name'];
  $imgTempName = $_FILES['image']['tmp_name'];
  $image_size = $_FILES['image']['size'];
  $image_type = $_FILES['image']['type'];
  $path = $uploadDir . $imgName;
  if (move_uploaded_file($imgTempName, $path)) {

    $query = "INSERT INTO images(image, date, annonce_id)VALUES('$imgName', now(), '$id')";

    $result = mysqli_query($conn, $query);
    // $row = mysqli_fetch_assoc($result);
    if ($result) {
    
      header("location: /home");
      exit();

    } else {
      echo "nooooooooooooo";
    }
  } else{
    echo "<h4 style='color:red;'>Error. Please try again!!</h4>";
  }
}