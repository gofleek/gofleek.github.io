<?php
  $hostname = "bc2l0wbzhcviixrey9r6-mysql.services.clever-cloud.com";
  $username = "us5gpkebmrkuvtha";
  $password = "hERWCpoIzhcT7kAZXZIY";
  $dbname = "bc2l0wbzhcviixrey9r6";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }

?>
