<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');

    $user = htmlentities($_POST['user']);
    $story = htmlentities($_POST['story']);
    $comment = htmlentities($_POST['comment']);

    if(isset($_SERVER['HTTP_REFERER'])) {
      $prev_page = $_SERVER['HTTP_REFERER'];
    } else {
      $prev_page = "../pages/story_page.php?story_id=$story";
    }

    //try {
      addComment($user, $story, $comment);
      header("Location: ".$prev_page);
    //} catch (PDOException $e) {
      //$_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to post comment");
      //die(header("Location: ".$prev_page));
    //}
?>