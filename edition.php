<?php
ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Edition d\'Annonce'; // For the Title
include "config/connect.php";
include "config/header.php";
include "config/navbar.php";

if (!isset($_SESSION['ID'])) {
  header('Location: index');
}

if (isset($_GET["anonce_id"]) and !empty($_GET["anonce_id"])) {
  $id = htmlspecialchars($_GET['anonce_id']);

  // Check le nombre d'image avant d'envoer 
  // Je Limit a 5 le nombre d'images par Annonce
  // Get Images from Annonces_images Table
  $sql = "SELECT image_url FROM annonces_images WHERE annonce_id = $id";
  $result = mysqli_query($conn, $sql);
  $image_count = mysqli_num_rows($result);

  $uploadDir = "img/";

  if (isset($_POST["insert"])) {

    $imgName = $_FILES['image']['name'];
    $imgTempName = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_type = $_FILES['image']['type'];

    $file_ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $file_ext;
    $path = $uploadDir . $new_filename;

    if (move_uploaded_file($imgTempName, $path)) {

      if ($image_count < 5) {
        $query = "INSERT INTO annonces_images(image_url, date, annonce_id)VALUES('$new_filename', now(), '$id')";
        $result = mysqli_query($conn, $query);
        if ($result) {

          header("location: edition?anonce_id=$id");
          exit();

        } else {
          echo "Un Problem est survenu l'image na pas pu envoyer";
        }
      } else {
        echo "<div class='container alert alert-danger text-danger fs-5 fw-medium mb-3'>
          Le nombre D'images autoriser est de 5 Images.</div>";
      }
    } else {
      echo "<div class='container alert alert-danger text-danger fs-5 fw-medium'>Error. Please essaie encore!..</div>";
    }
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
      $formError[] = "Ye Adresse cant be Empty";
    }
    if ($status == 0) {
      $formError[] = 'Status cant be Empty';
    }

    foreach ($formError as $error) {
      echo '<div class="container alert alert-danger text-danger fw-medium">' . $error . '</div>';
      //redirectHome2($theMs2, 'back', 7);
    }

    if (empty($formError)) {

      $query = "UPDATE annonces SET title='$title', sub_title='$sub_title', description='$desc',
        adresse='$adresse', status='$status', price='$price' WHERE id = '$id'";
      $result = mysqli_query($conn, $query);
      if ($result) {
        $formError[] = "Votre article a bien eté modifié...";
        // header("Location: edition?annonce_id=$id");
      } else {
        $message = "Woops Un problem est survenu... ";
      }
    }
    // mysqli_close($conn);
  } else {
    $message = "Veuillez remplir tous les champs...";
  }
  ?>


  <div class="container">
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
      <h3 class="title">Update Page</h3>
      <div class="edit-designes">
        <!-- File input -->
        <div>
          <label for="fileInput" class="custom-file-label">Select Image</label>
          <input type="file" id="fileInput" name="image">
          <input class="btn btn-sm btn-primary m-2" type="submit" name="insert" value="Ajouter" />
        </div>

        <!-- Image Count -->
        <div class="droite">
          <label class="counts"><?= $image_count ?></label>
        </div>
      </div>
    </form>

    <!-- Get Images from Annonces_images Table -->
    <div class="edit-design">
      <?php
      $query = "SELECT * FROM annonces_images WHERE annonce_id = $id";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <a href="img/<?= $row['image_url'] ?>" target="blanc">
            <div class="edit-photo">
              <img src="img/<?= $row['image_url'] ?>" width="60" height="40" alt="...">
          </a>
          <div>
            <a href="#" class="btn btn-success btn-sm" onclick="openFileBrowser()">Edition</a>
            <!-- <a href="connections/delete-image?anonce_id=<?= $row['annonce_id'] ?>" class="btn btn-danger btn-sm" -->
            <a href="connections/delete-image?anonce_id=<?= $row['annonce_id'] ?>&image_id=<?= $row['img_id'] ?>"
              class="btn btn-danger btn-sm">Supprimer</a> <!-- onclick="confirmDelete3()" -->
          </div>
        </div>

        <?php
        }
      } ?>
  </div>

  <!-- Form Field to Update -->
  <!-- Start Name Field-->
  <form class="form-horizontal m-auto" method="POST">
    <?php
    $stmt = "SELECT * from annonces WHERE id = $id ";
    $result = mysqli_query($conn, $stmt);
    $row = mysqli_fetch_assoc($result);
    if ($row > 0) { ?>

      <!-- <label class="col-sm-2 control-label">Title</label> -->
      <div class="col-sm-12 col-md-8">
        <input type="text" class="form-control" name="title" value="<?= $row['title'] ?>" placeholder="un titre" />
      </div>

      <!-- <label class="col-sm-2 control-label">Sub Title</label> -->
      <div class="col-sm-12 col-md-8">
        <input type="text" class="form-control" name="sub-title" placeholder="sous titre"
          value="<?= $row['sub_title'] ?>" />
      </div>

      <!-- <label class="col-sm-2 control-label">Description</label> -->
      <div class="col-sm-12 col-md-8">
        <input type="text" class="form-control" name="description" value="<?= $row['description'] ?>"
          placeholder="decrire votre annonce " />
      </div>

      <!-- <label class="col-sm-2 control-label">Price</label> -->
      <div class="col-sm-12 col-md-8">
        <input type="text" class="form-control" name="price" value="<?= $row['price'] ?>$"
          placeholder="prix de l'annonce" />
      </div>

      <!-- <label class="col-sm-2 control-label">Adresse </label> -->
      <div class="col-sm-12 col-md-8">
        <select name="adresse" class="form-control">
          <option value="0">...</option>
          <option value="ngazidja">Ngazidja</option>
          <option value="anjouan">Anjouan</option>
          <option value="moheli">Moheli</option>
          <option value="mayotte">Mayotte</option>
        </select>
      </div>

      <!-- <label class="col-sm-2 control-label">Status</label> -->
      <div class="col-sm-12 col-md-8">
        <select name="status" class="form-control">
          <option value="0">...</option>
          <option value="neuve" <?php if ($row['status'] == 'neuve') {
            echo 'selected';
          } ?>>Neuve</option>

          <option value="comme neuve" <?php if ($row['status'] == 'comme neuve') {
            echo 'selected';
          } ?>>Comme Neuve
          </option>

          <option value="occasion" <?php if ($row['status'] == 'occasion') {
            echo 'selected';
          } ?>>Occasion</option>

          <option value="correct" <?php if ($row['status'] == 'correct') {
            echo 'selected';
          } ?>>Correct</option>
        </select>
      </div>

      <!-- <label class="col-sm-2 control-label">Members</label> -->
      <div class="col-sm-12 col-md-8 d-none">
        <select name="member" class="form-control">
          <!-- <option value="0">...</option> -->
          <option value="0"><?php echo $_SESSION['ID'] ?></option>

        </select>
      </div>

      <!--
      <label class="col-sm-2 control-label">Category</label>
      <div class="col-sm-10 col-md-6">
        <select name="category" class="form-control">
          <option value="0">...</option>

        </select>
      </div>
      -->

      <div class="col-12 col-md-8 edit-annonce">
        <input class="btn btn-success edit-button" type="submit" name="update" value="Update " />
      </div>

    <?php } ?>

  </form>
  </div>

<?php } else {
  header('Location: index');
  ob_end_flush(); // End Error Handrler
} ?>


<?php include 'config/footer.php'; ?>



<style>
  #fileInput {
    display: none;
    /* Hide the default file input */
  }

  .custom-file-label {
    display: inline-block;
    padding: 6px 16px;
    background-color: rgb(217, 223, 231);
    color: black;
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
  }

  .custom-file-label:hover {
    background-color: rgb(201, 201, 202);
  }
</style>




<script>

  // Open Upload Files
  function openFileBrowser() {
    document.getElementById('fileInput').click();
  }


  function confirmDelete3() {
    if (confirm("Are you sure you want to delete this item?")) {
      // User clicked "OK"
      document.getElementById('deleteForm').submit();
    } else {
      // User clicked "Cancel"
      alert("Deletion canceled.");
    }
  }
</script>