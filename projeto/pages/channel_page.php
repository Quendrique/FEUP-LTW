<?php
  include_once('../includes/incl_session.php');
  include_once('../database/db_channels.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_account.php');
  include_once('../templates/tpl_channel.php');

  $channel_id = $_GET['channel'];
  $channel = getChannel($channel_id);

  draw_header();
  draw_sidebar_login();
  draw_channel_page($channel);
  draw_footer();
?>