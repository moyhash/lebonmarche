<!DOCTYPE html>
<html lang="en">

<?php
  // Index page na pas de session
  session_start();
  $pageTitle = 'Home page'; // For the Title
  include "config/connect.php";
  include "config/header.php";
  include "config/navbar.php";
  // include "funct/functions.php";

  // if (isset ($_SESSION['ID'])) {
  //   echo 'welcome ' . $_SESSION['ID'];
  // }else {
  //   header('Location: index.php');
  // }
  $query = "SELECT DISTINCT name FROM category";
  $result = mysqli_query($conn, $query);

?>


<div class="container">
  <!-- <hr>
    <div class="panel-bar">
    <form class="d-flex search">

      <input type="search" name="search" id="search_text" class="form-control me-2 rounded-4 border-secondary w-60 " placeholder="Search...">
      <input class="btn btn-outline-success rounded-4" type="submit" value="Search">
    </form>
    <div class="message">
        <a class="deposer" href="annonce.php">Deposer Annonse</a>
    </div>
    </div>
  <hr> -->
  

  <h5>&nbsp; Voir Les Categories</h5>
  <div class="by-category">
    <div class="vehicule">
      <?php
        if($result) { 

          while ($cat = mysqli_fetch_assoc($result)) { ?>

            <span><?= $cat['name'] ?></span>
        <?php } 
        }
      ?>
    
       <!-- 
        <img src="" width="160" height="120" alt="">
        <span>Voiture</span> -->
    </div>

    <div class="telephone">
      Telephone
    </div>

    <div class="electromanager">
      Electromenager
    </div>

    <div class="informatique">
      Informatique
    </div>

  </div>
  <!-- End 4 Last Anonces -->

  <h5>&nbsp; 5 Dernieres Annonces</h5>
  <div class="container">
    <div class="index-design">
    
      <?php
        $query = "SELECT * FROM annonces ORDER BY ID DESC LIMIT 5";
        //$query = "SELECT annonces.*, annonces_images.image_url AS AnnonceImage from annonces
        //INNER JOIN annonces_images ON annonces_images.annonce_id = annonces.id ORDER BY ID DESC LIMIT 2";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) { ?>
          
          
          <div class="index-annonces">

            <!-- Get Images from Annonces_images Table -->
            <?php
              $stmt = "SELECT * FROM annonces_images WHERE annonce_id = {$row['id']}";
              $get = mysqli_query($conn, $stmt); 
              $images =  mysqli_fetch_assoc($get);
            ?>

            <div class="photo" width="380px">
              <a href="details?anonce_id=<?= $row['id'] ?>">
              <img src="img/<?=$images['image_url'] ?>" class="img" width="150px" height="120px" alt="..."></a>
            </div>

            <div class="text-secondary index_desc">
              <a href="details?anonce_id=<?= $row['id'] ?>">
                <h5 class="title"><?= $row['title'] ?> </h5>
                <h6 class="sub-title"><?php echo $row['sub_title'] ?></h6>
                <span class="date">Date : <?= $row['date'] ?></span>
            </div></a>
          </div>
          <?php
          }
        } 
      ?>
    </div>
  </div>

  <!-- Next-->
  <section id="learn" class="">
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


  <!-- Section Pagination -->
   <?php include 'preview-next.php'; ?>

</div>

<?php include 'config/footer.php'; ?>