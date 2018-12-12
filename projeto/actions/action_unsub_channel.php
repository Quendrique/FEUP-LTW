<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $user = htmlentities($_POST['user']);
    $channel = htmlentities($_POST['channel']);

    try {
      unsubFrom($user, $channel);
      $_SESSION['messages'][] = array('type' => 'success', 'content' => "Unsubcribed from channel $channel");
      header("Location: ../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to unsubscribe from channel $channel");
      die(header("Location: ../pages/channel_page.php?channel=$channel"));
    }

?>