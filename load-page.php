<?php

$pageTitle = 'Home page'; // For the Title
include "config/connect.php";
include "config/header.php";
include "config/navbar.php";

$limit = 4;

$query = "SELECT COUNT(*) FROM annonces";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$total_rows = $row[0];
$total_pages = ceil($total_rows / $limit);

?>


<div class="container">
  <div id="target-content">loading...</div>

  <ul class="pagination">

    <?php if (!empty($total_pages)) {
      for ($i = 1; $i <= $total_pages; $i++) {

        if ($i == 1) { ?>

          <li class="pageitem active" id="<?php echo $i; ?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i; ?>" class="page-link">
            <?php echo $i; ?>
            </a>
          </li>

          <?php }else { ?>
          <li class="pageitem" id="<?php echo $i; ?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i; ?>" class="page-link">
            <?php echo $i; ?>
            </a>
          </li>
        <?php }
      }
    } ?>
  </ul>
</div>

<script>
  $(document).ready(function () {

    $("#target-content").load("pagination.php?page=1");
    $(".page-link").click(function () {
      var id = $(this).attr("data-id");
      var select_id = $(this).parent().attr("id");
      $.ajax({

        url: "pagination.php",
        type: "GET",
        data: { page: id },
        cache: false,

        success: function (dataResult) {
          $("#target-content").html(dataResult);
          $(".pageitem").removeClass("active");
          $("#" + select_id).addClass("active");
        }
      });
    });
  });
</script>