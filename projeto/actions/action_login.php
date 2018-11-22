<?php
  include_once('../database/db_user.php');

  session_start();

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (checkUserPassword($username, $password)) 
  {
    $_SESSION['username'] = $username;
    header('Location: ../pages/mainpage.php');
  } 
  else 
  {
    header('Location: ../pages/login.php/?message=Username+or+password+invalid');
  }

?>