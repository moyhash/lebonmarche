<?php
// include "config/connect.php";
// include "config/header.php";
// include "config/navbar.php";

$limit = 2; // Number of announcements per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch total number of announcements
$total_query = "SELECT COUNT(*) FROM annonces";
$total_result = mysqli_query($conn, $total_query);
$total_announcements = mysqli_fetch_array($total_result)[0];
$total_pages = ceil($total_announcements / $limit);

// Fetch announcements for the current page
$query = "SELECT * FROM annonces ORDER BY ID DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);
?>

<div class="container">
  <div class="index-design">
    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="index-annonces">

        <?php
          $stmt = "SELECT * FROM annonces_images WHERE annonce_id = {$row['id']}";
          $get = mysqli_query($conn, $stmt); 
          $images =  mysqli_fetch_assoc($get);
        ?>

          <a href="details.php?anonce_id=<?= $row['id'] ?>">
            <div class="photo" width="380px">
              <img src="img/<?= $images['image_url'] ?>" class="img" width="150px" height="120" alt="...">
            </div>
            <div class="text-secondary index_desc">
              <h5 class="title"><?= $row['title'] ?></h5>
              <h6 class="sub-title"><?= $row['sub_title'] ?></h6>
              <span class="date">Date: <?= $row['date'] ?></span>
            </div>
          </a>
        </div>
        <?php
      }
    } ?>
  </div>

  <!-- SECTION BUTTONS -->
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?page=<?= $page - 1 ?>" class="prev-button"><</a>
        
        <?php endif; ?>

        <?php if ($page < $total_pages): ?>
          <a href="?page=<?= $page + 1 ?>" class="next-button">></a>
        <?php endif; ?>
  </div>
</div>



<style>
  .container {
    position: relative;
    width: 100%;
    padding: 20px;
  }

  .index-annonces {
    /* border: 1px solid red; */
  }

  .pagination {
    text-align: center;
    margin-top: 20px;
  }

  .prev-button {
    position: absolute;
    background-color: #ccc;
    width: 50px;
    top: 120px;
    left: 1px;
    font-size: 30px;
    color: white;
    padding: 5px;
    text-decoration: none;
    margin: 2px;
    border-radius: 50%;
  }

  .next-button {
    position: absolute;
    background-color: #ccc;
    width: 50px;
    top: 120px;
    right: 1px;
    font-size: 30px;
    color: white;
    padding: 2px;
    text-decoration: none;
    margin: 5px;
    border-radius: 50%;
  }

  .prev-button:hover,
  .next-button:hover {
    background-color: #0056b3;
  }
</style>