<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $username = htmlentities($_POST['username']);
    $channel = htmlentities($_POST['channel']);
    $description = htmlentities($_POST['description']);

    if (!preg_match ("/^[a-zA-Z0-9]+$/", $channel)) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Special characters are not allowed in the channel's name");
      die(header("Location: ../pages/add_channel.php?username=$username"));
    }

    try {
      addChannel($username, $channel, $description);
      header("Location: ../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Failed to create channel $channel");
      die(header('Location: ../pages/add_channel.php'));
    }

?>