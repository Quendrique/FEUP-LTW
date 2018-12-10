<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_account.php');
  include_once('../database/db_channels.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  $repeat_password = $_POST['repeat_password'];

  if($password !== $repeat_password)
  {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Passwords do not match");
    header('Location: ../pages/signup.php');
  }
  else
  {
    try 
    {
      signup($username, $password);
      subTo($username,'general');
      $_SESSION['username'] = $username;
      header("Location: ../pages/edit_profile.php?user=$username");
    } catch (PDOException $e) 
    {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Username already taken");
      header('Location: ../pages/signup.php');
    }
}
?>