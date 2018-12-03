<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_upload.php');

  $title = $_POST['title'];
  $description = $_POST['description'];
  
  if (!empty($_FILES["image"]["tmp_name"]))
    $image = file_get_contents($_FILES['image']['tmp_name']);
  else $image = null;

  $track = file_get_contents($_FILES['track']['tmp_name']);

  $username = $_GET['username'];

    $date = date('Y-m-d H:i:s');
    echo $date;

    //try {
      upload($username,$title,$description,$date,$image,$track);
      //header("../pages/channel_page.php?channel=general");
    //} catch (PDOException $e) {
      //die(header('Location: ../pages/add_channel.php'));
    //}  
?>