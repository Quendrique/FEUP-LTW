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

  /**
   * Checks if a user is subscribed to a channel
   */
  function isSubbedTo($username, $channel) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM subscribed WHERE user = ?
                          AND channel = ?');
    $stmt->execute(array($username, $channel));
    return $stmt->fetchAll(); 
  }

  /**
   * Checks if a user is subscribed to a channel
   */
  function subTo($username, $channel) {
    global $db;
    $stmt = $db->prepare('INSERT INTO subscribed VALUES (NULL, ?, ?)');
    $stmt->execute(array($username, $channel)); 
  }

?>