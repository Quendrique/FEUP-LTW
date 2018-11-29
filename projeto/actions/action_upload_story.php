<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_upload.php');

  $title = $_POST['title'];
  $description = $_POST['description'];
  $image = file_get_contents($_FILES['image']['tmp_name']);
  $track = file_get_contents($_FILES['track']['tmp_name']);

  $username = $_GET['username'];

    upload($username,$title,$description,$image,$track);
?>