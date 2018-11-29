<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $user = $_POST['user'];
    $channel = $_POST['channel'];

    subTo($user, $channel);

    header("Location: ../pages/channel_page.php?channel=$channel");

?>