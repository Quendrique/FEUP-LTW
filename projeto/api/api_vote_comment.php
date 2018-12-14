<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');

    header('Content-Type: application/json');

    $user = htmlentities($_POST['user']);
    $action = htmlentities($_POST['action']);
    $comment = htmlentities($_POST['comment']);
    $story = htmlentities($_POST['story']);

    try {

      $prev_vote = hasUserVotedComment($user, $comment);

      if ($prev_vote == null) {
        voteComment($user, $comment, $action);
      } else if ($prev_vote['type'] === $action) {
        removeVoteComment($user, $comment);
      } else {
        changeVoteComment($user, $comment);
      }

      $updatedComment = getComment($comment);
      echo json_encode($updatedComment);
      
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to vote");
      die(header("Location: ../pages/story_page.php?story_id=$story"));
    }

?>