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
    $stmt = $db->prepare('SELECT * FROM stories ORDER BY [datetime] DESC');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  function getAllChannelStoriesOrderDate($channel) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN channels
                          WHERE stories.channel = channels.name AND channels.name = ?
                          ORDER BY [datetime] DESC');
    $stmt->execute(array($channel));
    return $stmt->fetchAll(); 
  }

  function getAllChannelStoriesOrderDateRev($channel) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN channels
                          WHERE stories.channel = channels.name AND channels.name = ?
                          ORDER BY [datetime] ASC');
    $stmt->execute(array($channel));
    return $stmt->fetchAll(); 
  }

  function getAllChannelStoriesOrderVote($channel) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN channels
                          WHERE stories.channel = channels.name AND channels.name = ?
                          ORDER BY (upvotes + downvotes) DESC');
    $stmt->execute(array($channel));
    return $stmt->fetchAll(); 
  }

  function getAllChannelStoriesOrderAlph($channel) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN channels
                          WHERE stories.channel = channels.name AND channels.name = ?
                          ORDER BY title COLLATE NOCASE ASC');
    $stmt->execute(array($channel));
    return $stmt->fetchAll(); 
  }

  function getAllChannelStoriesOrderAlphRev($channel) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN channels
                          WHERE stories.channel = channels.name AND channels.name = ?
                          ORDER BY title COLLATE NOCASE DESC');
    $stmt->execute(array($channel));
    return $stmt->fetchAll(); 
  }

  function getAllChannelStoriesOrderComments($channel) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN channels
                          WHERE stories.channel = channels.name AND channels.name = ?
                          ORDER BY comments DESC');
    $stmt->execute(array($channel));
    return $stmt->fetchAll(); 
  }

  function getAllStoriesOrderDate() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories ORDER BY [datetime] DESC');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  function getAllStoriesOrderDateRev() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories ORDER BY [datetime] ASC');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  function getAllStoriesOrderVote() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories ORDER BY (upvotes + downvotes) DESC');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  function getAllStoriesOrderAlph() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories ORDER BY title COLLATE NOCASE ASC');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  function getAllStoriesOrderAlphRev() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories ORDER BY title COLLATE NOCASE DESC');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  function getAllStoriesOrderComments() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories ORDER BY comments DESC');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }

  function getAllSubStoriesOrderDate($user) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN subscribed
                          WHERE stories.channel = subscribed.channel AND subscribed.user = ?
                          ORDER BY [datetime] DESC');
    $stmt->execute(array($user));
    return $stmt->fetchAll(); 
  }

  function getAllSubStoriesOrderDateRev($user) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN subscribed
                          WHERE stories.channel = subscribed.channel AND subscribed.user = ?
                          ORDER BY [datetime] ASC');
    $stmt->execute(array($user));
    return $stmt->fetchAll(); 
  }

  function getAllSubStoriesOrderVote($user) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN subscribed
                          WHERE stories.channel = subscribed.channel AND subscribed.user = ?
                          ORDER BY (upvotes + downvotes) DESC');
    $stmt->execute(array($user));
    return $stmt->fetchAll(); 
  }

  function getAllSubStoriesOrderAlph($user) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN subscribed
                          WHERE stories.channel = subscribed.channel AND subscribed.user = ?
                          ORDER BY title COLLATE NOCASE ASC');
    $stmt->execute(array($user));
    return $stmt->fetchAll(); 
  }

  function getAllSubStoriesOrderAlphRev($user) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN subscribed
                          WHERE stories.channel = subscribed.channel AND subscribed.user = ?
                          ORDER BY title COLLATE NOCASE DESC');
    $stmt->execute(array($user));
    return $stmt->fetchAll(); 
  }

  function getAllSubStoriesOrderComments($user) {
    global $db;
    $stmt = $db->prepare('SELECT stories.* FROM stories JOIN subscribed
                          WHERE stories.channel = subscribed.channel AND subscribed.user = ?
                          ORDER BY comments DESC');
    $stmt->execute(array($user));
    return $stmt->fetchAll(); 
  }

  function getStoriesByUser($user) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE author = ?');
    $stmt->execute(array($user));
    return $stmt->fetchAll();  
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
    $stmt = $db->prepare('SELECT * FROM comments WHERE story_id = ? ORDER BY datetime ASC');
    $stmt->execute(array($story));
    return $stmt->fetchAll(); 
  }

  function getComment($comment) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM comments WHERE id = ?');
    $stmt->execute(array($comment));
    return $stmt->fetch(); 
  }

  function getCommentsByUser($user) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM comments WHERE author = ? ');
    $stmt->execute(array($user));
    return $stmt->fetchAll();  
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
   * Check if user has voted on a comment
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