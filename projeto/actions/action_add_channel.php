<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $username = $_POST['username'];
    $channel = $_POST['channel'];

    addChannel($username, $channel);

    header("Location: ../pages/channel_page.php?channel=$channel");

?>