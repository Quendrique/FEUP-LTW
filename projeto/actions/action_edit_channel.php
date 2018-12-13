<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $channel = htmlentities($_POST['channel']);
    $description = htmlentities($_POST['description']);

    try {
      editChannel($channel, $description);
      header("Location: ../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to edit channel $channel");
      die(header("Location: ../pages/channel_page.php?channel=$channel"));
    }
?>