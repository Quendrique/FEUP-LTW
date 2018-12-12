<?php
    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_channel_list.php');

    $channels = getChannels();
  
    draw_header();
    draw_navBar(null);
    draw_sidebar_login();
    draw_channels($channels);
    draw_footer();
?>