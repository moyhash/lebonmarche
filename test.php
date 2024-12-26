
<?php 
   include "connect.php";
    // Check if user Existe
    $stmt = "SELECT * from annonces";
    $result = mysqli_query($conn, $stmt);
    $row = mysqli_fetch_assoc($result);

    // if User Exist do some thing
    if($row > 0){
      //$_SESSION['ID'] = $row['id']; // Create a Session ID

      echo 'welcome ' . $row['id'];
      exit();
    }


?>