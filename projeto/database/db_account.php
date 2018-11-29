<?php

  include('../database/db_connection.php');

  function login($username, $password) 
  {
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch()?true:false;
  }

  function getUserData($username) 
  {
    global $db;
    $stmt = $db->prepare('SELECT username, name, birth_day, gender, email, nationality
                         FROM users WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }

  function signup($username, $password) 
  {
    global $db;
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($username, sha1($password), null ,null, null, null, null));
  }

  function updateProfile($username, $name, $birthdate, $email, $gender, $nationality)
  {
    global $db;
    $stmt = $db->prepare('UPDATE users 
                          SET name = ?, birth_day = ?, email = ?, gender = ?, nationality = ?
                          WHERE username = ?');
    $stmt->execute(array($name, $birthdate, $email, $gender, $nationality, $username));
  }
?>