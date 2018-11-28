<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_channels.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_account.php');
  include_once('../templates/tpl_channel.php');

  $channel_name = $_GET['channel_name'];
  $channel = getChannel($channel_name);

  if (!isset($_SESSION['username']))
    draw_header(null);
  else
    draw_header($_SESSION['username']);

  draw_sidebar_login();
  draw_channel_page($channel);
  draw_footer();
?>