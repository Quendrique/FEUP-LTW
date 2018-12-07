<?php
  include('../database/db_connection.php');

  function searchStories($search) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE title LIKE ? ORDER BY [datetime] DESC');
    $stmt->execute(array($search));
    return $stmt->fetchAll();
  }

  function searchChannels($search) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM channels WHERE [name] LIKE ?');
    $stmt->execute(array($search));
    return $stmt->fetchAll();
  }
?>