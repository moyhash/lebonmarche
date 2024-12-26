<?php

//$conn = mysqli_connect('localhost', 'root','', 'webdata') OR die ('Not connected');
$conn = mysqli_connect('localhost','root','','bonmarche');

if(!$conn){
	echo 'Error: '.mysqli_connect_error();
}

// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
