<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_channels.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_account.php');
  include_once('../templates/tpl_channel.php');

  $channel_name = $_GET['channel'];
  try {
    $channel = getChannel($channel_name);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to access channel $channel_name");
    die(header("Location: ../pages/channels_list.php"));
  }

  try {
    $stories = getStoriesInChannel($channel_name);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to access stories in channel $channel_name");
    die(header("Location: ../pages/channels_list.php"));
  }

  if($channel == null) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Channel $channel_name does not exist");
    die(header("Location: ../pages/channels_list.php"));
  }

  if (!isset($_SESSION['username'])) {
    draw_header(null);
    draw_sidebar(null);
  }
  else {
    draw_header($_SESSION['username']);
    $subbed_channels = getSubbedChannels($_SESSION['username']);
    draw_sidebar($subbed_channels);
  }

  draw_channel_page($channel, $stories);
  draw_footer();
?>