<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');

    header('Content-Type: application/json');

    $user = htmlentities($_POST['user']);
    $action = htmlentities($_POST['action']);
    $story = htmlentities($_POST['story']);

    try {
      $prev_vote = hasUserVotedStory($user, $story);
      if ($prev_vote == null) {
        voteStory($user, $story, $action);
      } else if ($prev_vote['type'] === $action) {
        removeVoteStory($user, $story);
      } else {
        changeVoteStory($user, $story);
      }

      $updatedStory = getStory($story);
      echo json_encode($updatedStory);
      
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to vote");
      die(header("Location: ../pages/story_page.php?story_id=$story"));
    }

?>