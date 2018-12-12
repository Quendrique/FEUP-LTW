<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_upload.php');

  $title = htmlentities($_POST['title']);
  $description = htmlentities($_POST['description']);
  $username = htmlentities($_POST['username']);
  $date = date('d-m-Y H:i:s');
  $channel =  htmlentities($_POST['channels']);

    try {
      upload($username,$title,$description,$date,$channel);
      header("Location:../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Failed to upload to $channel  ");
      die(header('Location: ../pages/upload.php'));
    }  
?>