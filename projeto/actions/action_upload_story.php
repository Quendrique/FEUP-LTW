<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_upload.php');

  $title = $_POST['title'];
  $description = $_POST['description'];
  $username = $_POST['username'];

  $date = date('d-m-Y H:i:s');
  $channel =  $_POST['channels'];

    try {
      upload($username,$title,$description,$date,$channel);
      header("Location:../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      echo $e;
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Failed to upload to $channel  ");
      die(header('Location: ../pages/upload.php'));
    }  
?>