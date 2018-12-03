<?php
  include('../database/db_connection.php');

  function upload($username, $title, $description, $date, $image,$track) 
  {
    global $db;
    $stmt = $db->prepare('INSERT INTO stories VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(null, $title, $description ,$username, $date, $image, $track));
  }

  function getUploads() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }
?>  