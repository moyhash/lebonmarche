<?php
function getTitle()
{

  global $pageTitle; // Accessible any where

  if (isset($pageTitle)) {
    echo $pageTitle;
  } else {
    echo 'Default title';
  }
}


/*
¤¤ Home Redirect Function v1.0
¤¤ [ This Function Accept Pareameters ]
¤¤ $errorMsg = Echo The error Message
¤¤ $seconds = Seconds Before Redirecting
*/
function redirectHome($errorMsg, $seconds = 5)
{
  echo "<div class='alert alert-danger'> $errorMsg</div>";
  echo "<div class='alert alert-warning'>Server will Redirect to Home Page After $seconds Seconds.</div>";

  header("refresh:$seconds; url=../index"); // Refresh after Few Seconds
  exit();
}



/*
¤¤ Home Redirect Function v2.0
¤¤ [ This Function Accept Pareameters ]
¤¤ $theMsg = Echo The error Message [ Error | Success | Warning ]
¤¤ $url The Link You Want to Redirect To
¤¤ $seconds = Seconds Before Redirecting
*/
function redirectHome2($theMsg, $url = null, $seconds = 3)
{
  if ($url === null) {
    $url = 'index.php';
  } else {
    // $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ? $_SERVER['HTTP_REFERER'] : 'index.php';
    $url = $_SERVER['HTTP_REFERER'];
  }

  echo $theMsg;
  echo "<div class='alert alert-info'>You Will Redirected to $url Page After $seconds Seconds.</div>";

  header("refresh:$seconds; url=$url"); // To Refresh after Seconds
  exit();
}


