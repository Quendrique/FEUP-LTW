<?php

  include('../database/db_connection.php');
  include_once('../utils.php');

  function login($username, $password) 
  {
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    return $user !== false && password_verify($password, $user['password']);
  }

  function getUserData($username) 
  {
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
  }

  function signup($username, $password) 
  {
    $options = ['cost' => 12]; 
    global $db;
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, 0)');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options), null ,null, null, null, null));
  }

  function updateProfile($username, $name, $birthdate, $email, $gender, $nationality)
  {
    global $db;
    $stmt = $db->prepare('UPDATE users 
                          SET [name] = ?, birth_day = ?, email = ?, gender = ?, nationality = ?
                          WHERE username = ?');
    $stmt->execute(array($name, $birthdate, $email, $gender, $nationality, $username));
    if(isset($_FILES['image']['tmp_name'])) imageHandler($username ,"../img/users/");
  }
?>