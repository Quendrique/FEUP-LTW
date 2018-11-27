<?php
  include('db_connection.php');

  /**
   * Returns the list of channels
   */
  function getChannels() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM channels');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  /**
   * Returns a single specified channel
   */
  function getChannel($id) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM channels WHERE id = ?');
    $stmt->execute(array($id));
    return $stmt->fetchAll(); 
  }

?>