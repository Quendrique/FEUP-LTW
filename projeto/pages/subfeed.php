<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../database/db_channels.php');
    include_once('../templates/tpl_feed.php');


    if (!isset($_SESSION['username'])) {
        die(header('Location: ../pages/mainpage.php'));
    }
    else {
        draw_header($_SESSION['username']);
        draw_navBar($_SESSION['username']);
        $subbed_channels = getSubbedChannels($_SESSION['username']);
        draw_sidebar($subbed_channels, true);
        draw_sub_feed($_SESSION['username']);
    }
    
    draw_footer();
?>