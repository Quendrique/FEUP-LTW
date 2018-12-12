<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $channel = preg_replace ("/[<>]/", '^', $_POST['channel']);
    $description = preg_replace ("/[<>]/", '^', $_POST['description']);

    try {
      editChannel($channel, $description);
      $_SESSION['messages'][] = array('type' => 'success', 'content' => "Channel $channel edited");
      header("Location: ../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to edit channel $channel");
      die(header("Location: ../pages/channel_page.php?channel=$channel"));
    }
?>