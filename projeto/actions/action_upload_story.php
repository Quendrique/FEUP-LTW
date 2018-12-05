<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_upload.php');

  $title = $_POST['title'];
  $description = $_POST['description'];
  $username = $_POST['username'];
  
  if (!empty($_FILES["image"]["tmp_name"]))
    $image = file_get_contents($_FILES['image']['tmp_name']);
  else $image = null;

  $track = file_get_contents($_FILES['track']['tmp_name']);
  $date = date('Y-m-d H:i:s');
  $channel =  $_POST['channels'];

    try {
      upload($username,$title,$description,$date,$image,$track,$channel);
      header("Location:../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      echo $e;
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Failed to upload to $channel  ");
      die(header('Location: ../pages/upload.php'));
    }  
?>