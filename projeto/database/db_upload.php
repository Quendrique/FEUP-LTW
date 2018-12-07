<?php
  
  include('../database/db_connection.php');
  include('../utils.php');

  function upload($username, $title, $description, $date, $image, $track, $channel) 
  {
    global $db;
    $stmt = $db->prepare('INSERT INTO stories(title, text, author,datetime,upvotes,downvotes,coverImage, track,channel) VALUES( ?, ?, ?, ?, 0, 0, ?, ?, ?)');
    $stmt->execute(array($title, $description, $username, $date, $image, $track, $channel));
    
    $id = $db->lastInsertId();

    fileHandler($image,$id);
  }
?>