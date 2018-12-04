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
   * Returns the list of channels
   */
  function getChannelsNames() {
    global $db;
    $stmt = $db->prepare('SELECT name FROM channels');
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
  function addChannel($username, $channel, $description) {
    global $db;
    $stmt = $db->prepare('INSERT INTO channels VALUES(?, ?, ?)');
    $stmt->execute(array($channel, $username, $description));
    $stmt = $db->prepare('INSERT INTO subscribed VALUES(NULL, ?, ?)');
    $stmt->execute(array($username, $channel));
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
   * Subscribe a user to a channel
   */
  function subTo($username, $channel) {
    global $db;
    $stmt = $db->prepare('INSERT INTO subscribed VALUES (NULL, ?, ?)');
    $stmt->execute(array($username, $channel)); 
  }

  /**
   * Unsubscribes a user from a channel
   */
  function unsubFrom($username, $channel) {
    global $db;
    $stmt = $db->prepare('DELETE FROM subscribed WHERE user = ?
                          AND channel = ?');
    $stmt->execute(array($username, $channel)); 
  }

  /**
   * Returns all the stories from a channel
   */
  function getStoriesInChannel($channel) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE channel = ?');
    $stmt->execute(array($channel));
    return $stmt->fetchAll(); 
  }

  /**
   * Returns number of subcribers of a given channel
   */
  function getSubCount($channel) {
    global $db;
    $stmt = $db->prepare('SELECT COUNT(*) AS numSubs FROM subscribed WHERE channel = ?');
    $stmt->execute(array($channel));
    return $stmt->fetch(); 
  }

  function editChannel($name, $description)
  {
    global $db;
    $stmt = $db->prepare('UPDATE channels 
                          SET description = ?
                          WHERE name = ?');
    $stmt->execute(array($description, $name));
  }
?>