<?php

include './config/connect.php';

$limit = 4;

if (isset($_GET["page"])) {
  $page_number = $_GET["page"];
} else {
  $page_number = 1;
}

$initial_page = ($page_number - 1) * $limit;
?>

<div class="index-design">
<?php
  $query = "SELECT * FROM annonces LIMIT $initial_page, $limit";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) { ?>
    
    <div class="index-annonces">
      <a href="details.php?anonce_id=<?= $row['id'] ?> ">
      <div class="photo" width="380px">
        <img src="img/<?=$row['image'] ?>" class="img" width="150px" height="120" alt="...">
      </div>

      <div class="text-secondary index_desc">
          <h5 class="title"><?= $row['title'] ?> </h5>
          <h6 class="sub-title"><?php echo $row['sub_title'] ?></h6>
          <span class="date">Date : <?= $row['date'] ?></span>
      </div></a>
    </div>
    <?php
    }
  } ?>
</div>