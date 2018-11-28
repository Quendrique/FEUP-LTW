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
  function getChannel($channel_name) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM channels WHERE [name] = ?');
    $stmt->execute(array($channel_name));
    return $stmt->fetch(); 
  }

  /**
   * Adds a new channel
   */
  function addChannel($username, $channel_name) {
    global $db;
    $stmt = $db->prepare('INSERT INTO channels VALUES(NULL, ?, ?)');
    $stmt->execute(array($channel_name, $username));
  }

?>