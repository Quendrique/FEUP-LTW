<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');
    include_once('../templates/tpl_stories.php');

    $user = htmlentities($_POST['user']);
    $story = htmlentities($_POST['story']);
    $comment = htmlentities($_POST['comment']);

    try {
      $lastInsertId = addComment($user, $story, $comment);
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to post comment");
      die(header("Location: ../pages/story_page.php?story_id=$story"));
    }

    draw_comment(getComment($lastInsertId));
?>