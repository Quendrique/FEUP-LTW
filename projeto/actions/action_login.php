<?php
  include_once('../database/db_account.php');
  include_once('../includes/incl_session.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (login($username, $password)) 
  {
    $_SESSION['username'] = $username;
    header('Location: ../pages/mainpage.php');
  } 
  else 
  {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Username or password invalid");
    header('Location: ../pages/login.php');
  }

?>