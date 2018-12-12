<?php

  include_once('../includes/incl_session.php');
  include_once('../database/db_channels.php');

  header('Content-Type: application/json');

  $user = preg_replace ("/[<>]/", '^', $_POST['user']);
  $channel = preg_replace ("/[<>]/", '^', $_POST['channel']);
  $action = preg_replace ("/[<>]/", '^', $_POST['action']);
  
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