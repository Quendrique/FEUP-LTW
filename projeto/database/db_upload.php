<?php
  
  include('../database/db_connection.php');

  function upload($username, $title, $description, $date,$image,$track) 
  {
    global $db;
    $stmt = $db->prepare('INSERT INTO stories VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array( $title, $description ,$username, $date, $image, $track));

    $stmt = $db->prepare('INSERT INTO storyInChannel VALUES(?, ?, ?)');
    $stmt->execute(array(null, 20, "general"));
  }
?>