<?php
  include('../database/db_connection.php');

  function searchStories($search) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE title LIKE :search ORDER BY [datetime] DESC');
    $stmt->execute(array(':search' => '%'.$search.'%'));
    return $stmt->fetchAll();
  }

  function searchChannels($search) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM channels WHERE [name] LIKE :search');
    $stmt->execute(array(':search' => '%'.$search.'%'));
    return $stmt->fetchAll();
  }

  function searchComments($search) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM comments WHERE [text] LIKE :search');
    $stmt->execute(array(':search' => '%'.$search.'%'));
    return $stmt->fetchAll();
  }
?>