<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_channels.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_account.php');
  include_once('../templates/tpl_channel.php');
  include_once('../templates/tpl_stories.php');

  $channel_name = preg_replace ("/[<>]/", '^', $_GET['channel']);
  try {
    $channel = getChannel($channel_name);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to access channel $channel_name");
    die(header("Location: ../pages/channels_list.php"));
  }

  try {
    $subCount = getSubCount($channel_name);
  } catch(PDOException $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to access $channel_name's subscription count");
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
    draw_sidebar(null, true);
  }
  else {
    draw_header($_SESSION['username']);
    $subbed_channels = getSubbedChannels($_SESSION['username']);
    draw_sidebar($subbed_channels, true);
  }
?>
  <section id="channel_page" class="page">
<?php
  draw_channel_page($channel, $subCount);
  draw_stories($stories);
?>
  </section>
<?php
  draw_footer();
?>