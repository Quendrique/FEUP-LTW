<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_account.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  $repeat_password = $_POST['repeat_password'];

  if($password !== $repeat_password)
    header('Location: ../pages/signup.php?message=Passwords+do+not+match');
  else
  {
    try 
    {
      signup($username, $password);
      $_SESSION['username'] = $username;
      header('Location: ../pages/mainpage.php');
    } catch (PDOException $e) 
    {
      header('Location: ../pages/signup.php?message=Username+already+taken');
    }
}
?>