<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    
    draw_header(null);
    draw_sidebar(null, false);
    draw_signup();
    draw_footer();
?>