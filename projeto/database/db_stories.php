<?php
  
  include('../database/db_connection.php');

  /**
   * Returns a story 
   */
  function getStory($story) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE id = ?');
    $stmt->execute(array($story));
    return $stmt->fetch(); 
  }
  function getAllStories() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  function getStoryInChannel($channel) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE channel = ?');
    $stmt->execute(array($story));
    return $stmt->fetch(); 
  }

  function getUpvotesStory($story) {
    global $db;
    $stmt = $db->prepare('SELECT upvotes FROM stories WHERE id = ?');
    $stmt->execute(array($story));
    return $stmt->fetch(); 
  }

  function getDownvotesStory($story) {
    global $db;
    $stmt = $db->prepare('SELECT downvotes FROM stories WHERE id = ?');
    $stmt->execute(array($story));
    return $stmt->fetch(); 
  }

  /**
   * Returns a story's comments 
   */
  function getComments($story) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM comments WHERE story_id = ? ORDER BY datetime DESC');
    $stmt->execute(array($story));
    return $stmt->fetchAll(); 
  }

  function getComment($comment) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM comments WHERE id = ?');
    $stmt->execute(array($comment));
    return $stmt->fetch(); 
  }

  /**
   * Vote on a story (0 - downvote; 1 - upvote)
   */
  function voteStory($user, $story, $action) {
    global $db;
    $stmt = $db->prepare('INSERT INTO vote VALUES (NULL, ?, ?, ?, NULL)');
    $stmt->execute(array($action, $user, $story));
  }

  /**
   * Changes a vote on a particular story
   */
  function changeVoteStory($user, $story) {
    global $db;
    $stmt = $db->prepare('UPDATE vote SET [type] = 1 - [type] WHERE author = ?
                          AND story_id = ?');
    $stmt->execute(array($user, $story));
  }

  /**
   * Remove a vote from a story
   */
  function removeVoteStory($user, $story) {
    global $db;
    $stmt = $db->prepare('DELETE FROM vote WHERE author = ?
                          AND story_id = ?');
    $stmt->execute(array($user, $story));
  }

  /**
   * Check if user has voted on a story
   */
  function hasUserVotedStory($user, $story) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM vote WHERE author = ?
                          AND story_id = ?');
    $stmt->execute(array($user, $story));
    return $stmt->fetch();
  }

  /**
   * Vote on a story (0 - downvote; 1 - upvote)
   */
  function voteComment($user, $comment, $action) {
    global $db;
    $stmt = $db->prepare('INSERT INTO vote VALUES (NULL, ?, ?, NULL, ?)');
    $stmt->execute(array($action, $user, $comment));
  }

  /**
   * Changes a vote on a particular story
   */
  function changeVoteComment($user, $comment) {
    global $db;
    $stmt = $db->prepare('UPDATE vote SET [type] = 1 - [type] WHERE author = ?
                          AND comment_id = ?');
    $stmt->execute(array($user, $comment));
  }

  /**
   * Remove a vote from a story
   */
  function removeVoteComment($user, $comment) {
    global $db;
    $stmt = $db->prepare('DELETE FROM vote WHERE author = ?
                          AND comment_id = ?');
    $stmt->execute(array($user, $comment));
  }

  /**
   * Check if user has voted on a story
   */
  function hasUserVotedComment($user, $comment) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM vote WHERE author = ?
                          AND comment_id = ?');
    $stmt->execute(array($user, $comment));
    return $stmt->fetch();
  }

  /**
   * Add a comment
   */
  function addComment($user, $story, $comment) {
    global $db;
    $stmt = $db->prepare('INSERT INTO comments VALUES (NULL, ?, ?, 0, 0, date("now"), ?)');
    $stmt->execute(array($story, $user, $comment));
    return $db->lastInsertId();
  }

?>