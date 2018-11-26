<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_profile.php');
    include_once('../database/db_account.php');

    draw_header();
    draw_sidebar_login();

    $username = $_GET['user'];

    $userdata = getUserData($username);

    if(!empty($userdata)) //if user exists
    {
        printProfile($userdata[0]);
    }
    else //if user does not exist
    {
        printProfileError($username);
    }

    draw_footer();
?>