<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $username = $_POST['username'];
    $channel_name = $_POST['channel_name'];

    addChannel($username, $channel_name);

    header("Location: ../pages/channel_page.php?channel_name=$channel_name");

?>