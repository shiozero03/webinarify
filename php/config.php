<?php

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $dbname = 'webinarify';
  
  $conn = mysqli_connect($server, $user, $pass, $dbname);
  $base_url = 'http://localhost/webinarify/';
  if (!$conn) {
    die('error'.mysqli_error());
  }

?>