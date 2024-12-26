<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['ID'])) {
    echo 'true';
} else {
    echo 'false';
}
