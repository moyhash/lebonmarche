<?php
session_start();
$pageTitle = 'Page d\'utilisateur'; // For the Title
include "config/connect.php";
include "config/header.php";
include "config/navbar.php";
//include '..functions/functions.php';

/*if (!isset($_SESSION['ID'])) {
 header('Location: ./index.php');
}*/

if (isset($_GET["member_id"]) and !empty($_GET["member_id"])) {
  $get_id = htmlspecialchars($_GET['member_id']);

  // $sql = "SELECT * FROM annonces WHERE user_id = {$_SESSION['ID']}";
  // $sql = "SELECT image FROM images WHERE image_id = annonce_id";
  $sql = "SELECT annonces.*, users.name AS UserName from annonces
  INNER JOIN users ON users.userid = annonces.user_id WHERE user_id = $get_id ";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);

  ?>

  <div class="container">
    <div class="user-details">
      <div class="member">
        <!-- <i class="fa fa-user fa-2x"></i> -->
        <?php $upper = substr($user['UserName'], 0, 1); ?>
        <span class="profil-avatar"><?= ucfirst($upper) ?></span>
        <div class="profil-name">
          <h5><?= ucfirst($user['UserName']) ?> </h5>
          <h6> Ferivié</h6>
        </div>
      </div>

      <div class="desc">
        <span> Description </span>
        <p> <?= $user['description'] ?></p>
      </div>
    </div>

    <!-- Nombre d'Annonce pour chaque Membre -->
    <div class="count">
      <?php echo mysqli_num_rows($result); ?> Annonces Publiés
    </div>

    <div class="all-annonce">
      <?php

      $qury = "SELECT annonces.*, users.name AS UserName from annonces
      INNER JOIN users ON users.userid = annonces.user_id WHERE user_id = $get_id ";
      $result = mysqli_query($conn, $qury);

      if (mysqli_num_rows($result) > 0) {
        while ($annone = mysqli_fetch_assoc($result)) { ?>

          <div class="image-part">

            <?php
            $stmt = "SELECT * FROM annonces_images WHERE annonce_id = {$annone['id']}";
            $get = mysqli_query($conn, $stmt);
            $images = mysqli_fetch_assoc($get);
            ?>

            <a href=" details?anonce_id=<?= $annone['id'] ?> ">
              <div class="photo" width="380px">
                <img src="img/<?= $images['image_url'] ?>" width="220px" height="160" alt="...">
            </a>
          </div>

          <div class="text-secondary annone_desc">
            <h5 class="title"><?= $annone['title'] ?> </h5>
            <h6 class="subtitle"><?php echo $annone['sub_title'] ?></h6>
            <span>Publié le: <?= $annone['date'] ?></span>
            <h6>dddddddddddddd</h6>
          </div>
        </div>

      <?php }
      } ?>
  </div>
  </div>


<?php } else {
  echo '<div class="container">';
  // echo '<div class="alert alert-danger">no data for till now</div>';
  $theMsg = '<div class="alert alert-danger">no data for till now</div>';
  redirectHome($theMsg);
  echo '</div>';
} ?>

<?php include 'config/footer.php'; ?>