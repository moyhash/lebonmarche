<!DOCTYPE html>
<html lang="en">

<?php
// session_start();
  include "config/connect.php";

  /*if (isset ($_SESSION['ID'])) {
    echo 'welcome ' . $_SESSION['ID'];
  }else {
    header('Location: login.php');
  }*/
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multi images upload</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h2 align="center">Multiple Images Uploading PHP</h2>
  <?php 
   if(isset($_GET['msg']) AND $_GET['msg'] == 'Inserted'){
      echo'<h4 align="center">Image Uploading Successfully</h4>';
   }
  ?>
  <div class="formdesign">
    <form action="index.php" method="POST" enctype="multipart/form-data">
       Please Select Images <br><br>
       <input type="file" name="image[]" multiple>
       <input type="submit" name="submit" value="Upload">
    </form>
    <br><br>
    <?php 
      $sql = "SELECT images FROM multimages";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){ ?>
          <!-- <div id="image-container"> -->
            <img src="img/<?php echo $row['images'] ?>" width="100" height="100">
          <!-- </div> -->
    <?php
      }
    }
    
    ?>
  </div>
  
</body>
</html>