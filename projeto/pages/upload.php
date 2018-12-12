<?php
    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_upload.php');
    include_once('../database/db_account.php');

    if (!isset($_SESSION['username']))
      die(header('Location: ../pages/mainpage.php'));

    $username = $_SESSION['username'];
    draw_header($username);
    $subbed_channels = getSubbedChannels($username);
    draw_sidebar($subbed_channels, false);

    draw_upload($username);

    draw_footer();
?>

