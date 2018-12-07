<?php
  
  include('../database/db_connection.php');
  include('../utils.php');

  function upload($username, $title, $description, $date, $channel) 
  {
    global $db;
    $stmt = $db->prepare('INSERT INTO stories(title, text, author,datetime,upvotes,downvotes,coverImage, track,channel) VALUES( ?, ?, ?, ?, 0, 0, ?, ?, ?)');
    $stmt->execute(array($title, $description, $username, $date, null, null, $channel));
    
    $id = $db->lastInsertId();

    imageHandler($id);
    trackHandler($id);
  }
?>