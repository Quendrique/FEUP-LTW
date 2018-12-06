<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');

    $user = $_POST['user'];
    $action = $_POST['action'];
    $story = $_POST['story'];

    if(isset($_SERVER['HTTP_REFERER'])) {
      $prev_page = $_SERVER['HTTP_REFERER'];
    } else {
      $prev_page = "../pages/story_page.php?story_id=$story";
    }

    try {

      $prev_vote = hasUserVotedStory($user, $story);

      if ($prev_vote == null) {
        voteStory($user, $story, $action);
      } else if ($prev_vote['type'] === $action) {
        removeVoteStory($user, $story);
      } else {
        changeVoteStory($user, $story);
      }
      $_SESSION['messages'][] = array('type' => 'success', 'content' => "Voted");
      header("Location: ".$prev_page);
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to vote");
      die(header("Location: ".$prev_page));
    }
?>