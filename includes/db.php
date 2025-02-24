<?php
  $server = "mysql-db-activity";
  $username = "admin-dev";
  $password = "COS@-56ac";
  $dbname = "db";
  
  $conn = new mysqli($server, $username, $password, $dbname);
  $conn->set_charset("utf8");
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // echo "Connected successfully!";  
?>