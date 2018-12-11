<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    
    draw_header(null);
    $message = $_GET['message'];
    draw_login($message);
    draw_footer();
?>