<?php
    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_channel.php');

    $username = htmlentities($_GET['username']);

    if (!isset($_SESSION['username']) || $_SESSION['username'] != $username)
      die(header('Location: ../pages/mainpage.php'));

    draw_header($username);
    draw_navBar($username);
    $subbed_channels = getSubbedChannels($username);
    draw_sidebar($subbed_channels, false);  

    add_new_channel($username);

    draw_footer();
?>