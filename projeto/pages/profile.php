<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_profile.php');
    include_once('../database/db_account.php');
    include_once('../database/db_channels.php');

    $username = $_GET['user'];

    $userdata = getUserData($username);

    if(!empty($userdata)) //if user exists
    {
        draw_header($username);
        printProfile($userdata[0]);
        $subbed_channels = getSubbedChannels($username);
        draw_sidebar($subbed_channels);
    }
    else //if user does not exist
    {
        draw_header(null);
        draw_sidebar(null);
        printProfileError($username);
    }

    draw_footer();
?>