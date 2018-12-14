<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_account.php');
    include_once('../database/db_stories.php');

    $username = htmlentities($_POST['user']);
    $story_id = htmlentities($_POST['story']);

    try {
      $user = getUserData($username);
      $story = getStory($story_id);
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to get user points");
      die(header("Location: ../pages/profile.php?user=$username"));
    }

    if ($story['author'] == $user['username']) { ?>
      <?=$user['points']?>
    <?php }
?>