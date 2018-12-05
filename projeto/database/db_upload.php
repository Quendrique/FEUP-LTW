<?php
  
  include('../database/db_connection.php');

  function upload($username, $title, $description, $date, $image, $track, $channel) 
  {
    global $db;
    $stmt = $db->prepare('INSERT INTO stories VALUES(NULL, ?, ?, ?, ?, ?, 0, 0, ?, ?)');
    $stmt->execute(array($title, $description, $username, $date, $image, $track, $channel));
  }
?>