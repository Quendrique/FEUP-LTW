<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_profile.php');
    include_once('../database/db_account.php');

    draw_header();
    draw_sidebar_login();

    $username = $_GET['user'];

    if (!isset($_SESSION['username']) || $_SESSION['username'] != $username)
      die(header('Location: ../pages/mainpage.php'));

    $userdata = getUserData($username);

    printProfileEdit($userdata[0]);

    draw_footer();
?>