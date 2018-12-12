<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $username = htmlentities($_POST['username']);
    $channel = htmlentities($_POST['channel']);
    $description = htmlentities($_POST['description']);

    try {
      addChannel($username, $channel, $description);
      $_SESSION['messages'][] = array('type' => 'success', 'content' => "Channel $channel created");
      header("Location: ../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Failed to create channel $channel");
      die(header('Location: ../pages/add_channel.php'));
    }

?>