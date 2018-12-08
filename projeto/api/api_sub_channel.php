<?php

  include_once('../includes/incl_session.php');
  include_once('../database/db_channels.php');

  header('Content-Type: application/json');

  $user = $_POST['user'];
  $channel = $_POST['channel'];
  $action = $_POST['action'];
  
  //try {

    if ($action) { // 1 - sub
      subTo($user, $channel);
    } else { // 0 - unsub
      unsubFrom($user, $channel);
    }

    echo json_encode(getSubCount($channel));

    //$_SESSION['messages'][] = array('type' => 'success', 'content' => "Subscribed to channel $channel");
    //header("Location: ../pages/channel_page.php?channel=$channel");
  //} catch (PDOException $e) {
    //$_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to subscribe to channel $channel");
    //die(header("Location: ../pages/channel_page.php?channel=$channel"));
  //}
?>