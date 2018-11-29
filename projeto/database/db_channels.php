<?php
  
  include('../database/db_connection.php');

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
  function getChannel($channel) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM channels WHERE [name] = ?');
    $stmt->execute(array($channel));
    return $stmt->fetch(); 
  }

  /**
   * Adds a new channel
   */
  function addChannel($username, $channel) {
    global $db;
    $stmt = $db->prepare('INSERT INTO channels VALUES(?, ?)');
    $stmt->execute(array($channel, $username));
  }

  /**
   * Returns all channels to which a user is subscribed
   */
  function getSubbedChannels($username) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM subscribed WHERE user = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll(); 
  }

?>