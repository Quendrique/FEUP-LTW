<?php
    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_channel.php');

    $username = $_GET['username'];

    if (!isset($_SESSION['username']) || $_SESSION['username'] != $username)
      die(header('Location: ../pages/mainpage.php'));

    draw_header($username);
    draw_sidebar_login();  

    add_new_channel($username);

    draw_footer();
?>