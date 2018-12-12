<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_stories.php');
    include_once('../database/db_stories.php');

    //header('Content-Type: application/json');

    $criteria = htmlentities($_POST['criteria']);
    $caller = htmlentities($_POST['caller']);

    if (!isset($_SESSION['username'])) {
      die(header('Location: ../pages/mainpage.php'));
    } else {
      $user = $_SESSION['username'];
    }

    if ($caller == 'sub_feed') {
      switch($criteria) {
        case 'date-desc':
          $sorted_stories = getAllSubStoriesOrderDate($user);
          break;
        case 'date-asc':
          $sorted_stories = getAllSubStoriesOrderDateRev($user);
          break;
        case 'alph-asc':
          $sorted_stories = getAllSubStoriesOrderAlph($user);
          break;
        case 'alph-desc':
          $sorted_stories = getAllSubStoriesOrderAlphRev($user);
          break;
        case 'vote':
          $sorted_stories = getAllSubStoriesOrderVote($user);
          break;
        case 'comment':
          $sorted_stories = getAllSubStoriesOrderComments($user);
          break;
      }
    } else if ($caller == 'main_page') {
      switch($criteria) {
        case 'date-desc':
          $sorted_stories = getAllStoriesOrderDate($user);
          break;
        case 'date-asc':
          $sorted_stories = getAllStoriesOrderDateRev($user);
          break;
        case 'alph-asc':
          $sorted_stories = getAllStoriesOrderAlph($user);
          break;
        case 'alph-desc':
          $sorted_stories = getAllStoriesOrderAlphRev($user);
          break;
        case 'vote':
          $sorted_stories = getAllStoriesOrderVote($user);
          break;
        case 'comment':
        $sorted_stories = getAllStoriesOrderComments($user);
          break;
      }
    } else { //channel page
      $channel = htmlentities($_POST['channel']);
      switch($criteria) {
        case 'date-desc':
          $sorted_stories = getAllChannelStoriesOrderDate($channel);
          break;
        case 'date-asc':
          $sorted_stories = getAllChannelStoriesOrderDateRev($channel);
          break;
        case 'alph-asc':
          $sorted_stories = getAllChannelStoriesOrderAlph($channel);
          break;
        case 'alph-desc':
          $sorted_stories = getAllChannelStoriesOrderAlphRev($channel);
          break;
        case 'vote':
          $sorted_stories = getAllChannelStoriesOrderVote($channel);
          break;
        case 'comment':
          $sorted_stories = getAllChannelStoriesOrderComments($channel);
          break;
      }
    }

    draw_stories($sorted_stories);
?>