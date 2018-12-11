<?php
  
  include('../database/db_connection.php');
  include('../utils.php');

  function upload($username, $title, $description, $date, $channel) 
  {
    global $db;
    $stmt = $db->prepare('INSERT INTO stories(title, text, author,datetime,upvotes,downvotes,channel) VALUES( ?, ?, ?, ?, 0, 0, 0, ?)');
    $stmt->execute(array($title, $description, $username, $date, $channel));
    
    $id = $db->lastInsertId();

    imageHandler($id,"../img/stories/");
    trackHandler($id);
  }
?>