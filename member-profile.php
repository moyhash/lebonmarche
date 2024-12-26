<?php
ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Profile page pour user'; // For the Title
include "config/connect.php";
include "config/header.php";
include "config/navbar.php";


if (!isset($_SESSION['ID'])) {
  header('Location: index');
 // echo 'welcome ' . $_SESSION['ID'];
}