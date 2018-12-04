<?php
  
  include('../database/db_connection.php');

  /**
   * Returns a story 
   */
  function getStory($story) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE id = ?');
    $stmt->execute(array($story));
    return $stmt->fetch(); 
  }

  function getStoryInChannel($channel) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE channel = ?');
    $stmt->execute(array($story));
    return $stmt->fetch(); 
  }

  /**
   * Returns a story's comments 
   */
  function getComments($story) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM comments WHERE story_id = ?');
    $stmt->execute(array($story));
    return $stmt->fetchAll(); 
  }

?>