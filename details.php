<?php
ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Details de l\'annonce'; // For the Title
include "config/connect.php";
include "config/header.php";
include "config/navbar.php";

/*if (!isset($_SESSION['ID'])) {
  header('Location: ../index.php');
   // echo 'welcome ' . $_SESSION['ID'];
} */

if (isset($_GET["anonce_id"]) and !empty($_GET["anonce_id"])) {
  $id = htmlspecialchars($_GET['anonce_id']);

  ?>
  <!-- <h6 clas="user">Membre depuis 2024</h6> -->
  <div class="container">

    <!-- Show large Image Hiden-->
    <h6>HERE SHOWING IMAGE</h6>
    <H6>Je click sur une image ouvrir un modal widh button Xclose Preview<<|>>Nexet</H6>
    <div class="slide-container">
      <div id="largeImage" class="large-image">
        <!-- <img id="largeImg" src="img/default.png" class="img" width="620px" height="400px" alt="..."> -->
        <!-- IMAGE SRC WILL COMMING FROM JQUERY -->
      </div>
      <!-- Next and previous buttons -->
      <a id="prev" class="select">&#10094;</a>
      <a id="next" class="select">&#10095;</a>
    </div>


    <!-- Get Images from Annonces_images Table -->
    <div class="col-md-9 col-sm-12 deitails-thumbnails">
      <?php
      $query = "SELECT img_id, `image_url` FROM annonces_images WHERE annonce_id = $id";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        while ($row_img = mysqli_fetch_assoc($result)) { ?>
          <div class="thumbnail fancybox" data-image="img/<?= $row_img["image_url"] ?>">
            <!-- <a href=""> -->
            <img src="img/<?= $row_img['image_url'] ?>" alt="<?= $row_img["img_id"] ?>" class="image" width="120" height="80">
            <!-- </a> -->
          </div>
        <?php }
      }
      ?>
    </div>


    <!-- Start Parti Bas -->
    <div class="row m-auto parti-bas">

      <?php
      // $stmt = "SELECT * from annonces WHERE id = $id "; 
      $stmt = "SELECT annonces.*, users.name AS UserName, users.email AS UserEmail from annonces
      INNER JOIN users ON users.userid = annonces.user_id WHERE id = $id ";
      $resultat = mysqli_query($conn, $stmt);
      $row = mysqli_fetch_assoc($resultat);
      if ($row > 0) { ?>

        <div class="desc-part col-12 col-md-8 mb-2">
          <h3><?= $row['title'] ?> </h3>

          <p> <?= $row['sub_title'] ?> </p>
          <h4 class="prix"> <?= $row['price'] ?>$</h4>
          <p><?= $row['ville'] ?>     <?= $row['region'] ?>     <?= $row['adresse'] ?> </p>
          <h5> <?= $row['status'] ?> </h5><br>
          <h5> <?= $row['UserEmail'] ?> </h5><br>

          <div class="desc">
            <span> Description </span>
            <p> <?= $row['description'] ?></p>
          </div>

          <h6>Publié le:<?= $row['date'] ?></h6>
        </div>
      <?php } ?>

      <!-- Deuxieme Parti
     Select all Annonces For The Current User Annonce
     $row['user_id'] == annonces.user_id de l'Annonce qui est Ouvert Actuellement
     -->
      <?php $select = "SELECT annonces.*, users.name AS UserName from annonces
        INNER JOIN users ON users.userid = annonces.user_id WHERE user_id = {$row['user_id']}";
        $count = mysqli_query($conn, $select);
        $user = mysqli_fetch_assoc($count);
      ?>

      <div class="details-part col-12 col-md-8">
        <div class="member">
          <a href="user-page?member_id=<?= $user['user_id'] ?>">
            <?php $upper = substr($user['UserName'], 0, 1); ?>
            <span class="details-avatar d-block"><?= ucfirst($upper) ?></span>
            <div class="details-name d-block">
              <h5><?= ucfirst($user['UserName']) ?> </h5>
              <!-- <?php //echo mysqli_num_rows($result); ?> Annonces -->
              <?php echo $count->num_rows; ?> Voir tous ses Annonces
            </div>
            <!-- <i class="fa fa-user fa-2x"></i> -->
          </a>
        </div>

        <div class="desc">
          <span> Description </span>
          <p> <?= $user['description'] ?></p>
        </div>

        <a href="connections/messagerie?userid=<?= $user['user_id'] ?>" class="btn btn-primary ">
          <i class="fa-solid fa-envelope"></i> Envoyer un message</a>

        <h2><?= $user['user_id'] ?></h2>
      </div>

    </div>
    <!-- End Parti Bas -->

    <!-- Aficher Les 4 derniers Annonces en Bas-->
    <div class="deitails-design">
      <?php
      $query = "SELECT * FROM annonces ORDER BY ID ASC LIMIT 5";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>

          <div class="index-annonces">
            <!-- Get Images from Annonces_images Table -->
            <?php
              $stmt = "SELECT * FROM annonces_images WHERE annonce_id = {$row['id']}";
              $get = mysqli_query($conn, $stmt); 
              $images =  mysqli_fetch_assoc($get);
            ?>

            <a href="details?anonce_id=<?= $row['id'] ?> ">
              <div class="photo" width="380px">
                <img src="img/<?= $images['image_url'] ?>" class="img" width="150px" height="120px" alt="...">
              </div>

              <div class="text-secondary index_desc">
                <h5 class="title"><?= $row['title'] ?> </h5>
                <h6 class="sub-title"><?php echo $row['sub_title'] ?></h6>
                <span class="date">Date : <?= $row['date'] ?></span>
              </div>
            </a>
          </div>
          <?php
        }
      } ?>
    </div>
    <!-- End 4 derniers An/*-nonces-->
  </div>

<?php } else {
  header('Location: ../index');

  ob_end_flush(); // End Error Handrler
} ?>


<!-- CREATION DU MODEL -->
<!-- <div class="container"> -->
<div id="myModal" class="full-screen">
  <!-- Here show an important message -->
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>

    <div class="slide-container">
      <div id="largeImage" class="large-image">
        <img id="modalImage" src="" class="img" width="620px" height="400px" alt="...">
        <div id="caption"></div>
        <!-- IMAGE SRC WILL COMMING FROM JQUERY -->
      </div>
      <!-- Next and previous buttons -->
      <a id="prev" class="select">&#10094;</a>
      <a id="next" class="select">&#10095;</a>
    </div>

  </div>

</div>
<!-- </div>  -->



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>

  // Thumbnail Click Add Class Active to the Thumbnail Version 1.0
  /*let mode = document.querySelectorAll(".thumbnail");
  mode.forEach((item) => {
    item.addEventListener("click", (eo) => {
      for (var i = 0; i < mode.length; i++) {
        mode[i].classList.remove("Active");
      }
      item.classList.add("Active");
    });
  });*/

  // Show the Large Image When Click Thumbnail Version 1.0
  /*$(document).ready(function(){
    $('.thumbnail').click(function(){
      var imageSrc = $(this).data('image');
      $('#largeImage').html('<a href="'+ imageSrc +'"><img src="'+ imageSrc +'" class="img" width="620" height="420" alt="Large Image"></a>');
      $('.large-image').show();
    });
  });*/


  $(document).ready(function () {
    let currentIndex = 0; // Image actuel
    // let currentImage = 0; 

    var images = $('.thumbnail');

    // This Function Regroupe 2 Functions
    // 1 Select The Image to Show
    // 2 Give the Active Class to the Thumbnail
    function showImage(index) {
      const thumbnails = document.querySelectorAll('.thumbnail');
      // currentImage = index; Sa marche aussi

      var imageSrc = images.eq(index).data('image');
      $('#largeImage').html('<img id="openmodal" src="' + imageSrc + '" class="img" width="620" height="420" alt="Large Image">');

      thumbnails.forEach((thumbnail, i) => {
        if (i === currentIndex) {
          thumbnail.classList.add('Active');
        } else {
          thumbnail.classList.remove('Active');
        }
      });
    }
    showImage(currentIndex); // To Show the First Image


    $('#prev').click(function () {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      showImage(currentIndex);
    });

    $('#next').click(function () {
      currentIndex = (currentIndex + 1) % images.length;
      showImage(currentIndex);
    });

    // Thumbnail Click Show the Image Version 2.0
    $('.thumbnail').click(function () {
      currentIndex = $(this).index();
      showImage(currentIndex);
      $('.large-image').show();
    });

  });


  //var images = document.querySelector("#openmodal");
  var imagess = document.getElementsByClassName('img');

  let modal = document.getElementById("myModal");
  var modalImg = document.getElementById("modalImage");
  let span = document.getElementsByClassName("close")[0];

  var captionText = document.getElementById("caption");

  /*images.addEventListener("click", (eo) => {
    modal.style.display = "block";
    // alert(location.hostname);
    modalImg.src = this.src;
  });*/

  for (var i = 0; i < imagess.length; i++) {
    imagess[i].onclick = function () {
      modal.style.display = "block";
      modalImg.src = this.src; // Set the modal image source to the clicked image source
    }
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

</script>


<?php include './config/footer.php'; ?>