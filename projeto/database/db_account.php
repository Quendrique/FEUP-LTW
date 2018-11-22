<?php
  include('db_connection.php');

  function login($username, $password) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch()?true:false;
  }

  function signup($username, $password) {
    global $db;
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?)');
    $stmt->execute(array($username, sha1($password), null));
  }
?>