<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_channels.php');
  include_once('../database/db_stories.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_account.php');
  include_once('../templates/tpl_channel.php');
  include_once('../templates/tpl_stories.php');

  $story_id = preg_replace ("/[<>]/", '^', $_GET['story_id']);
  try {
    $story = getStory($story_id);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to access story");
    die(header("Location: ../pages/channels_list.php"));
  }

  try {
    $comments = getComments($story_id);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to access comments");
    die(header("Location: ../pages/channels_list.php"));
  }

  if (!isset($_SESSION['username'])) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Log in to see comments");
    draw_header(null);
    draw_sidebar(null, false);
  }
  else {
    draw_header($_SESSION['username']);
    $subbed_channels = getSubbedChannels($_SESSION['username']);
    draw_sidebar($subbed_channels, false);
  }

  draw_story_page($story);
  draw_comments($comments, $story_id);
  draw_footer();
?>