<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_upload.php');

  $title = preg_replace ("/[<>]/", '^', $_POST['title']);
  $description = preg_replace ("/[<>]/", '^', $_POST['description']);
  $username = preg_replace ("/[<>]/", '^', $_POST['username']);
  $date = date('d-m-Y H:i:s');
  $channel =  preg_replace ("/[<>]/", '^', $_POST['channels']);

    try {
      upload($username,$title,$description,$date,$channel);
      header("Location:../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Failed to upload to $channel  ");
      die(header('Location: ../pages/upload.php'));
    }  
?>