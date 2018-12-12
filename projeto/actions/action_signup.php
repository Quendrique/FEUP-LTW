<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_account.php');
  include_once('../database/db_channels.php');

  $username = preg_replace ("/[<>]/", '^', $_POST['username']);
  $password = preg_replace ("/[<>]/", '^', $_POST['password']);
  $repeat_password = preg_replace ("/[<>]/", '^', $_POST['repeat_password']);

  if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
    die(header('Location: ../pages/signup.php?message=Username+can+only+contain+letters+and+numbers'));
  } else if($password !== $repeat_password) {
    die(header('Location: ../pages/signup.php?message=Passwords+do+not+match'));
  }
  else {
    try {
      signup($username, $password);
      subTo($username,'general');
      $_SESSION['username'] = $username;
      header("Location: ../pages/edit_profile.php?user=$username");
    } catch (PDOException $e) {
      header('Location: ../pages/signup.php?message=Username+already+taken');
    }
}
?>