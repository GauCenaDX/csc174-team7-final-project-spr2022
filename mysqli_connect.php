<?php
  // Update these info to connect to your own database
  DEFINE ('DB_HOST', 'xxxxxxxxxxx');
  DEFINE ('DB_USER', 'xxxxxxxxxxx');
  DEFINE ('DB_PASSWORD', 'xxxxxxxxxxx');
  DEFINE ('DB_NAME', 'xxxxxxxxxxx');

  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL ' . mysqli_connect_errno();
  } else {
    // echo 'Connect successfully';
    echo '';
  }
?>