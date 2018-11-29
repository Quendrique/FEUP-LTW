<?php
    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_upload.php');
    include_once('../database/db_account.php');

  
    $username = $_GET['user'];

    $userdata = getUserData($username);
    if(!empty($userdata)) //if user exists
    {
        draw_header($username);
        $subbed_channels = getSubbedChannels($username);
        draw_sidebar($subbed_channels);
    }
    else //if user does not exist
    {
        draw_header(null);
        draw_sidebar(null);
    }
    draw_upload();

   draw_footer();
?>

