<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');

    if (!isset($_SESSION['username']))
        draw_header(null);
    else
        draw_header($_SESSION['username']);

    draw_sidebar_login();
    draw_footer();
?>