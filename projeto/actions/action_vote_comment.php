<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');

    $user = htmlentities($_POST['user']);
    $action = htmlentities($_POST['action']);
    $comment = htmlentities($_POST['comment']);
    $story = htmlentities($_POST['story']);

    if(isset($_SERVER['HTTP_REFERER'])) {
      $prev_page = $_SERVER['HTTP_REFERER'];
    } else {
      $prev_page = "../pages/story_page.php?story_id=$story";
    }

    try {

      $prev_vote = hasUserVotedComment($user, $comment);

      if ($prev_vote == null) {
        voteComment($user, $comment, $action);
      } else if ($prev_vote['type'] === $action) {
        removeVoteComment($user, $comment);
      } else {
        changeVoteComment($user, $comment);
      }
      $_SESSION['messages'][] = array('type' => 'success', 'content' => "Voted");
      header("Location: ".$prev_page);
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to vote");
      die(header("Location: ".$prev_page));
    }
?>