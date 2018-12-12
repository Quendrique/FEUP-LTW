<?php
  include_once('../database/db_account.php');
  include_once('../includes/incl_session.php');

  $username = htmlentities($_POST['username']);
  $password = htmlentities($_POST['password']);

  if (login($username, $password)) 
  {
    $_SESSION['username'] = $username;
    header('Location: ../pages/mainpage.php');
  } 
  else 
  {
    header('Location: ../pages/login.php?message=Username+or+password+invalid');
  }

?>