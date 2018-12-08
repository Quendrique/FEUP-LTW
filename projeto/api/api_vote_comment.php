<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');

    $user = $_POST['user'];
    $action = $_POST['action'];
    $comment = $_POST['comment'];
    $story = $_POST['story'];

    //try {

      $prev_vote = hasUserVotedComment($user, $comment);

      if ($prev_vote == null) {
        voteComment($user, $comment, $action);
      } else if ($prev_vote['type'] === $action) {
        removeVoteComment($user, $comment);
      } else {
        changeVoteComment($user, $comment);
      }
      //$_SESSION['messages'][] = array('type' => 'success', 'content' => "Voted");
      //header("Location: ".$prev_page);
    //} catch (PDOException $e) {
      //$_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to vote");
      //die(header("Location: ".$prev_page));
    //}

    $updatedComment = getComment($comment);
    echo json_encode($updatedComment);
?>