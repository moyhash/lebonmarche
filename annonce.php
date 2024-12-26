<?php
session_start();
$pageTitle = 'Publié une Annonces';
include "config/connect.php";
include "config/header.php";
include "config/navbar.php";

if (isset($_SESSION['ID'])) {
  echo 'welcome ' . $_SESSION['ID'];
} else {
  header('Location: ./connections/login');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $sub = $_POST['sub-title'];
  $desc = $_POST['description'];
  $adresse = $_POST['adresse'];
  $status = $_POST['status'];
  $prix = $_POST['price'];
  $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
  $upload_dir = 'img/';
  $max_images = 5;

  try {
    // Ensure upload directory exists
    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0755, true);
    }

    // Insert the product into the Products table
    $query = "INSERT INTO annonces(title, sub_title, description, adresse, status, price, date, valid, user_id) 
      VALUES ('$title', '$sub', '$desc', '$adresse', '$status', '$prix', now(), 0, {$_SESSION['ID']})";

    // Check and process uploaded images
    if (!empty($_FILES['images']['name'][0])) {
      $file_count = count($_FILES['images']['name']);
      if ($file_count > $max_images) {
        throw new Exception("You can upload a maximum of $max_images images.");
      } else {
        //Max_Image is ok Execute 
        $result = mysqli_query($conn, $query);

        // Get the last inserted product ID
        $product_id = mysqli_insert_id($conn);
      }

      foreach ($_FILES['images']['name'] as $key => $filename) {
        $file_tmp = $_FILES['images']['tmp_name'][$key];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Validate file type
        if (!in_array($file_ext, $allowed_types)) {
          throw new Exception("Invalid file type: $filename");
        }

        // Generate a unique file name
        $new_filename = uniqid() . '.' . $file_ext;
        $file_path = $upload_dir . $new_filename;

        // Move the uploaded file
        if (!move_uploaded_file($file_tmp, $file_path)) {
          throw new Exception("Failed to upload file: $filename");
        }

        // Insert image record into Annonces_Images table
        $sql = "INSERT INTO annonces_images (image_url, date, annonce_id) 
          VALUES ('$new_filename', now(), '$product_id')";
        $stmt = mysqli_query($conn, $sql);
      }
    }

    // Commit the transaction
    $conn->commit();
    echo "Product and images added successfully!";
  } catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollBack();
    echo "Failed to add product: " . $e->getMessage();
  }
}
?>

<br><br>

<!-- <h2 class="title text-center">Add New Item</h2> -->
<div class="container">

  <form class="form-horizontal" action="annonce" method="POST" enctype="multipart/form-data">
    <div class="annonce-designes">
      <div class="col-md-3 titre">
        <input type="text" class="form-control titre" name="titre" placeholder="un titre pour la photo obligatoire">
      </div>
      <div><input type="file" name="images[]" multiple accept="image/*"></div>

      <!-- <div class="droite">
          <a class="logout" href="./logout.php">Logout</a>
        </div> -->
    </div>

    <div class="row m-auto">
      <!-- Start Name Field-->
      <div class="parti-form ">
        <div class="col-12 col-md-8">
          <input type="text" class="form-control" name="title" placeholder="un titre" />
        </div>
        <!-- End Name Field -->
        <!-- Start Sub Title Field-->
        <div class="col-12 col-md-8">
          <input type="text" class="form-control" name="sub-title" placeholder="sous titre" />
        </div>
        <!-- End Sub Title Field -->
        <!-- Start Description Field-->
        <div class="col-12 col-md-8">
          <input type="text" class="form-control" name="description" placeholder="decrire votre annonce " />
        </div>
        <!-- End Description Field -->
        <!-- Start Price Field-->
        <div class="col-12 col-md-8">
          <input type="text" class="form-control" name="price" placeholder="prix de l'annonce" />
        </div>
        <!-- End Price Field -->
        <!-- Start Country Field-->
        <div class="col-12 col-md-8">
          <select name="adresse" class="form-control">
            <option value="0">...</option>
            <option value="ngazidja">Ngazidja</option>
            <option value="anjouan">Anjouan</option>
            <option value="moheli">Moheli</option>
            <option value="mayotte">Mayotte</option>
          </select>
        </div>
        <!-- End Country Field -->
        <!-- Start Status Field -->
        <div class="col-12 col-md-8">
          <select name="status" class="form-control">
            <option value="0">...</option>
            <option value="neuve">Neuve</option>
            <option value="comme neuve">Com Neuve</option>
            <option value="occasion">Occasion</option>
            <option value="correct">Correct</option>
          </select>
        </div>
        <!-- End Status Field -->
        <!-- Start Members Field-->
        <div class="col-12 col-md-8">
          <select name="member" class="form-control">
            <option value="0">...</option>
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
          </div> -->
        <!-- End Categories Field -->

        <!-- Start Button Field-->
        <div class="col-12 col-md-8 edit-annonce">
          <input class="btn btn-success btn-md" type="submit" name="insert" value="Ajouter une Annonce " />
        </div>

      </div>

      <!-- Explication de  -->
      <div class="explications col-12 col-md-4">
        <h6>Renseigner tout les champs</h6>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, nam!
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, nam!
        </p>
        <p>
          Hawu tsaha wu deposé annone harimwa ye page yinu
          djaza ye papier yinou piya, na hweheleya wou pvenouwe ndro.
        </p>
      </div>
    </div>
  </form>
</div>


<!-- End Contact -->



<?php include 'config/footer.php'; ?>