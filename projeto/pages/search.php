<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_channels.php');
  include_once('../database/db_stories.php');
  include_once('../database/db_search.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_account.php');
  include_once('../templates/tpl_channel.php');
  include_once('../templates/tpl_stories.php');
  include_once('../templates/tpl_search.php');

  $search = $_GET['search'];
  
  try {
    $search_stories = searchStories($search);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to search for stories");
    die(header("Location: ../pages/mainpage.php"));
  }

  try {
    $search_channels = searchChannels($search);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to search for channels");
    die(header("Location: ../pages/mainpage.php"));
  }

  try {
    $search_comments = searchComments($search);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to search for comments");
    die(header("Location: ../pages/mainpage.php"));
  }

  if (!isset($_SESSION['username'])) {
    draw_header(null);
    draw_sidebar(null, false);
  }
  else {
    draw_header($_SESSION['username']);
    $subbed_channels = getSubbedChannels($_SESSION['username']);
    draw_sidebar($subbed_channels, false);
  }

  draw_search_results($search_stories, $search_channels, $search_comments);
  draw_footer();
?>