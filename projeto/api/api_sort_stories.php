<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_stories.php');
    include_once('../database/db_stories.php');

    //header('Content-Type: application/json');

    $criteria = $_POST['criteria'];

    if (!isset($_SESSION['username'])) {
      die(header('Location: ../pages/mainpage.php'));
    } else {
      $user = $_SESSION['username'];
    }

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
        //nao me apetece fazer isto :))))
        break;
    }

    draw_stories($sorted_stories);
?>