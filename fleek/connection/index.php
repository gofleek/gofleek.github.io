<?php

  $hostname = "b0dl83ysb8gpafiiittr-mysql.services.clever-cloud.com";
  $username = "uoujp5clzi2vmbwc";
  $password = "OdmZrZ9VcbRjLXHDRXle";
  $dbname = "b0dl83ysb8gpafiiittr";
  
  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
  else {
      echo "Connection successfull";
  }



switch($_SERVER['REQUEST_METHOD'])
{
case 'GET': 
        $the_request = &$_GET;
        echo json_encode($the_request);
        break;
case 'POST': 
        $the_request = &$_POST; 
        break;

}

  
?>
