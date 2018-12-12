<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');
    include_once('../templates/tpl_stories.php');

    $user = preg_replace ("/[<>]/", '^', $_POST['user']);
    $story = preg_replace ("/[<>]/", '^', $_POST['story']);
    $comment = preg_replace ("/[<>]/", '^', $_POST['comment']);

    //try {
      $lastInsertId = addComment($user, $story, $comment);
      //header("Location: ".$prev_page);
    //} catch (PDOException $e) {
      //$_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to post comment");
      //die(header("Location: ".$prev_page));
    //}

    //RETURN COMMENT!!
    draw_comment(getComment($lastInsertId));
?>