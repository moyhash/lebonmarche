<?php
ob_start();
session_start();
$pageTitle = 'Paramettrage de page'; // For the Title
include "config/connect.php";
include "config/header.php";
include "config/navbar.php";
// include 'functions/functions.php';

if (!isset($_SESSION['ID'])) {
  header('location: connections/login');
} else {

  // $sql = "SELECT * FROM annonces WHERE user_id = {$_SESSION['ID']}";
  // $sql = "SELECT image FROM images WHERE image_id = annonce_id";
  $sql = "SELECT annonces.*, users.name AS UserName from annonces
  INNER JOIN users ON users.userid = annonces.user_id WHERE user_id = {$_SESSION['ID']}";
  $result = mysqli_query($conn, $sql);
}
?>


<div class="container">

  <!-- <div class="designes">
    <div class="droite">
      <a class="deposer" href="#">Deposer Annonse</a>
      <a class="logout" href="./connections/logout.php">Logout</a> 
    </div>
  </div> -->

  <div class="home-design">

    <?php

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) { ?>

        <div class="home-annonces">
          <!-- <img src="..." class="card-img-top" alt="..."> -->
          <!-- Get Images from Annonces_images Table -->
          <?php
            $stmt = "SELECT * FROM annonces_images WHERE annonce_id = {$row['id']}";
            $get = mysqli_query($conn, $stmt); 
            $images =  mysqli_fetch_assoc($get);
            ?>
          <a href="details?anonce_id=<?= $row['id'] ?> ">
            <div class="photo">
              <img src="img/<?= $images['image_url'] ?>" width="180" height="120" alt="...">
            </div>

            <div class="text-secondary annone_desc">
              <h5 class="title"><?= $row['title'] ?> </h5>
              <h6 class="subtitle"><?php echo $row['sub_title'] ?></h6>
              <span>Date : <?= $row['date'] ?></span>
              <span>Ville : <?= $row['ville'] ?> .. <?= $row['adresse'] ?></span>
            </div>
          </a>

          <p><a href="edition?anonce_id=<?= $row['id'] ?>" class="btn-edition">Edition</a></p>
          <p><a href="details?anonce_id=<?= $row['id'] ?>" class="btn-details">Details</a></p>
          <p><a href="connections/delete-annonce?anonce_id=<?= $row['id'] ?>"
              class="btn btn-danger btn-sm btn-delete">Delete</a></p>
        </div>

        <!-- <div class="slider">
        <a href="img/<?= $row['image_url'] ?>" target="blanc">
          
        </a>
      </div> -->
        <?php
      }
    }

    ob_end_flush(); // End Error Handrler
    ?>
  </div>


  <!-- Next-->
  <section id="learn" class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center justify-content-center flex-row-reverse">
        <!-- <div class="col-md">
        <img src="./images/phone.svg" alt="" class="img-fluid w-50">
      </div> -->
        <div class="col-md py-4 paragraph">
          <h2>Where to go Next</h2>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Assumenda voluptates laboriosam iste est at,
            veniam fugit quas eveniet harum a fuga similique maxime facere dolorum eum,
            distinctio aliquam quidem rerum!</p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Nam assumenda nihil quis atque in ducimus iste quo quibusdam eius facere!</p>
        </div>
      </div>

      <div class="row align-items-center justify-content-center flex-row-reverse">
        <!-- <div class="col-md">
        <img src="./images/phone.svg" alt="" class="img-fluid w-50">
      </div> -->
        <div class="col-md py-4 paragraph">
          <h2>Where to go Next</h2>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Assumenda voluptates laboriosam iste est at,
            veniam fugit quas eveniet harum a fuga similique maxime facere dolorum eum,
            distinctio aliquam quidem rerum!</p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Nam assumenda nihil quis atque in ducimus iste quo quibusdam eius facere!</p>
        </div>
      </div>

    </div>
  </section>
</div>

<?php include 'config/footer.php'; ?>