
<?php 
if (isset($_SESSION['ID'])) {
  echo 'welcome ' . $_SESSION['ID'];
} else {
  header('Location: ./connections/login');
}

$uploadDir = "img/";

if (isset($_POST["insert"])) {

  $imgCount = count($_FILES['image']['name']);
  for ($img = 0; $img < $imgCount; $img++) {
    $imgName = $_FILES['image']['name'][$img];
    $imgTempName = $_FILES['image']['tmp_name'][$img];
    $path = $uploadDir . $imgName;
    if (move_uploaded_file($imgTempName, $path)) {

      $title = $_POST['title'];
      $sub = $_POST['sub-title'];
      $desc = $_POST['description'];
      $adresse = $_POST['adresse'];
      $status = $_POST['status'];
      $prix = $_POST['price'];

      $query = "INSERT INTO annonces(title, sub_title, description, adresse, status, price, date, valid, user_id) 
            VALUES ('$title', '$sub', '$desc', '$adresse', '$status', '$prix', '$imgName', now(), 0, {$_SESSION['ID']})";

      $result = mysqli_query($conn, $query);
      // $row = mysqli_fetch_assoc($result);
      if ($result) {
        header("location:home?msg=Inserted");
        exit();
      } else {
        echo "nooooooooooooo";
      }

      echo "<script>alert('file uploaded');
        </script>";
    } // if move close
  } // for close
}
?>


<?php
if (isset($_GET['msg']) and $_GET['msg'] == 'Inserted') {
  echo '<h4 align="center">Image Uploading Successfully</h4>';
}