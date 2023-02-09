<?php
  include 'includes/dbh.inc.php';
  
  $id = (int)$_POST['vals'];
  $sql = "SELECT * FROM users WHERE usersId= $id";
  
  $result = mysqli_query($conn, $sql);
  
  $row = mysqli_fetch_assoc($result);

      echo $row['verifyImage'];
