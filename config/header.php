<!DOCTYPE html>
<html lang="en">
<?php 
  include "./functions/functions.php";
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php getTitle() ?></title>
  <link rel="icon" type="image/x-icon"  href="./assets/Sans titre.ico" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <!-- <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
  <script defer src="./js/bootstrap.bundle.min.js"></script>
  <script defer src="./js/jquery.min-3.5.1.js"></script>

  <script defer src="./js/script.php"></script>
  <link rel="stylesheet" href="./style.css">
</head>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="./js/jquery.min-3.5.1.js"></script>


<script>

// Function to check if user is logged in or not
$(document).ready(function(){
  function isUserLoggedIn() {
    $.ajax({
        url: './check_login',
        type: 'GET',
        success: function(response) {
          if (response == 'true') {
              // If User is logged in, perform the action
              alert("We will redirect you to the Annonce page");  
              window.location.href = "./annonce";
          } else {
            window.location.href = "./connections/publier-annonce";
          }
        }
    });
  }

  // Perform action when the user click the button
  $('#performAction').click(function() {
      isUserLoggedIn();
      //alert("Action performed successfully!");
  });
}); 

</script>
