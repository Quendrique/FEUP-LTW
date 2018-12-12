<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../database/db_stories.php');

    header('Content-Type: application/json');

    $user = preg_replace ("/[<>]/", '^', $_POST['user']);
    $action = preg_replace ("/[<>]/", '^', $_POST['action']);
    $story = preg_replace ("/[<>]/", '^', $_POST['story']);

    //try {
      $prev_vote = hasUserVotedStory($user, $story);
      if ($prev_vote == null) {
        voteStory($user, $story, $action);
      } else if ($prev_vote['type'] === $action) {
        removeVoteStory($user, $story);
      } else {
        changeVoteStory($user, $story);
      }
      //$_SESSION['messages'][] = array('type' => 'success', 'content' => "Voted");
      //die(json_encode(array('error' => 'not_logged_in')));
    //} catch (PDOException $e) {
      //$_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to vote");
      //die(header("Location: ".$prev_page));
    //}

    $updatedStory = getStory($story);
    echo json_encode($updatedStory);
?>