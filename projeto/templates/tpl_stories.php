<?php 
include_once('../database/db_stories.php');

function draw_stories($stories) {
/**
 * Draws a channel's stories
 * page.
 */ ?>

  <section id="story_list">
    <script src="../audiojs/audio.min.js"></script>
    <script>audiojs.events.ready(function() {
            audiojs.createAll();
      });
    </script>
  <?php foreach($stories as $story) { 
    draw_story($story); 
    } ?>
  </section>
<?php } ?>

<?php function draw_story_page($story) {
/**
 * Draws a single story
 * page.
 */ ?>
  <section id="story_page" class="page">
  <script src="../audiojs/audio.min.js"></script>
  <script>audiojs.events.ready(function() {
            audiojs.createAll();
    });</script>
    <?php 
      draw_story($story); 
    ?>
    
</section>
<?php } ?>

<?php function draw_story($story) {
/**
 * Draws a single story
 * page.
 */ 
  $date_str = $story['datetime'];
  $date = strtotime($date_str);
  if (isset($_SESSION['username']))
    $uservote = hasUserVotedStory($_SESSION['username'], $story['id']);
  else
    $uservote = null;
  ?>
  <script type="text/javascript" src="../scripts/activity.js"></script>
  <article class = "blockStyle story">
    <header> 
    <?php $igmsrc = getUserImage($story['author']);?>
      <img src=<?=$igmsrc?> width=20 height="20" class="roundImage userImage">
    <a href="../pages/profile.php?user=<?= $story['author'] ?>"><?= $story['author']?></a>
      <span class="date"> <?= date('d M Y',$date)?></span>
    </header>
    <hr class = "invisibleLine">
    <section class = "blockLayout body">
      <h2><a href="../pages/story_page.php?story_id=<?=$story['id']?>"><?= $story['title']?></a></h2>
      <div class = "storyContent">
      <?php $igmsrc = getTrackImage( $story['id']);?>
      <img class="trackImage"  src=<?=$igmsrc?> width="200" height="200">
        <div class="storyTextAndTrack">
          <p><?=processMentions($story['text'])?></p>
          <audio src= "../tracks/<?=$story['id']?>.mp3" preload="auto"></audio>
        </div>
      </div>
    </div>
    </section>
    <hr class = "footerSeparator">
    <footer>
    <span class="channel"><a href="../pages/channel_page.php?channel=<?= $story['channel'] ?>">#<?= $story['channel']?></a></span>
    <?php if (isset($_SESSION['username'])) { ?>
      <a href="../pages/story_page.php?story_id=<?=$story['id']?>"><i class="fas fa-comment"></i></a>    
    <?php } else { ?>
      <a href="../pages/login.php?message="><i class="fas fa-comment"></i></a>   
    <?php } ?>
    <section class="upvote" data-storyid=<?=$story['id']?>>
      <?php if (isset($_SESSION['username'])) { 
        if($uservote != null && $uservote['type'] == 1){?>
      <button type="submit" class="voteup_btn colored voteupBtn"  user=<?=$_SESSION['username']?> action=1 story=<?=$story['id']?>>
        <i class="fas fa-caret-up fa-2x"></i>
      </button>
      <?php 
        }else
        {?>
          <button type="submit" class="voteup_btn voteupBtn" user=<?=$_SESSION['username']?> action=1 story=<?=$story['id']?>>
          <i class="fas fa-caret-up fa-2x"></i>
      </button>
        <?php } } else { ?>
          <a href="../pages/login.php?message=" class="voteup_btn voteupBtn" ><i class="fas fa-caret-up fa-2x"></i></a>   
      <?php } if($uservote != null && $uservote['type'] == 1) {?>  
      <span class="colored numUpvotes"><?= $story['upvotes']?></span>
      <?php } else { ?>
      <span class="numUpvotes"><?= $story['upvotes']?></span> 
      <?php } ?>
    </section>
    <section class="downvote" data-storyid=<?=$story['id']?>>
      <?php if (isset($_SESSION['username'])) { 
          if($uservote != null && $uservote['type'] == 0){?>
        <button type="submit" class="votedown_btn colored votedownBtn" user=<?=$_SESSION['username']?> action=0 story=<?=$story['id']?>>
          <i class="fas fa-caret-down fa-2x"></i>
        </button>
        <?php 
          }else
          {?>
            <button type="submit" class="votedown_btn votedownBtn" user=<?=$_SESSION['username']?> action=0 story=<?=$story['id']?>>
            <i class="fas fa-caret-down fa-2x"></i>
        </button>
          <?php } } else { ?>
          <a href="../pages/login.php?message=" class="votedown_btn votedownBtn"><i class="fas fa-caret-down fa-2x"></i></a>
        <?php } if($uservote != null && $uservote['type'] == 0) {?>  
        <span class="colored numDownvotes"><?= $story['downvotes']?></span>
        <?php } else { ?>
        <span class="numDownvotes"><?= $story['downvotes']?></span> 
        <?php } ?>
      </section> 
    </footer>  
  </article>
<?php 
} ?>

<?php function draw_comments($comments, $story) { ?>
  <section id="comment_list" class="page blockStyle">
    <?php if (isset($_SESSION['username'])) {
    draw_add_comment($story);
    ?>
    <section id=comments>
    <?php
    foreach($comments as $comment) {
      draw_comment($comment);
    } ?>
    </section>
  <?php } ?>
  </section>
<?php 
} ?>

<?php

include_once('../database/db_account.php');
include_once('../database/db_channels.php');

function processMentions($text) {
  $user_mention_regex = '/(?<=@)([\w_-]+)/';
  if (preg_match_all($user_mention_regex, $text, $matches)) {
    foreach($matches[1] as $match) {
      if (getUserData($match)) {
        $match_search = "@$match";
        $match_replace = '<a href="../pages/profile.php?user='. $match . '" class="mention">@' . $match . '</a>';
        $text = str_replace($match_search, $match_replace, $text);
      };
    }
  }

  $channel_mention_regex = '/(?<=#)([\w_-]+)/';
  if (preg_match_all($channel_mention_regex, $text, $matches)) {
    foreach($matches[1] as $match) {
      if (getChannel($match)) {
        $match_search = "#$match";
        $match_replace = '<a href="../pages/channel_page.php?channel='. $match . '" class="mention">#' . $match . '</a>';
        $text = str_replace($match_search, $match_replace, $text);
      };
    }
  }
  
  return $text;
}
?> 

<?php include_once('../templates/tpl_account.php');
function draw_comment($comment) {
/**
 * Draws a single comment
 */ 
  $date_str = $comment['datetime'];
  $date = strtotime($date_str);
  if (isset($_SESSION['username']))
    $uservote = hasUserVotedComment($_SESSION['username'], $comment['id']);
  else
    $uservote = null;
?>
  <article class="comment">
    <div class ="singleComment">
      <?php $igmsrc = getUserImage($comment['author']);?>
      <img  src=<?=$igmsrc?> width=35 height="35" class="roundImage userImage">
      <div class="comment">
      <span class="user"><a href="../pages/profile.php?user=<?= $comment['author'] ?>"><?= $comment['author']?></a></span>
        <p><?= $comment['text']?></p>
      </div>
    </div>
    <footer>
      <section class="upvote" data-commentid=<?=$comment['id']?>>
      <?php
          if($uservote != null && $uservote['type'] == 1){?>
            <button type="submit" class="voteup_btn colored commentVoteUp"  user=<?=$_SESSION['username']?> action=1 story=<?=$comment['story_id']?> comment=<?=$comment['id']?>>
              <i class="fas fa-caret-up fa-lg"></i>
            </button>
            <span class="colored numUpvotes"><?= $comment['upvotes']?></span>
        <?php 
          }else
          {?>
            <button type="submit" class="voteup_btn commentVoteUp"  user=<?=$_SESSION['username']?> action=1 story=<?=$comment['story_id']?> comment=<?=$comment['id']?>>
              <i class="fas fa-caret-up fa-lg"></i>
            </button>
            <span class="numUpvotes"><?= $comment['upvotes']?></span> 
      <?php } ?>
      </section>
      <section class="downvote" data-commentid=<?=$comment['id']?>>
      <?php
          if($uservote != null && $uservote['type'] == 0){?>
            <button type="submit" class="votedown_btn colored commentVoteDown"  user=<?=$_SESSION['username']?> action=0 story=<?=$comment['story_id']?> comment=<?=$comment['id']?>>
              <i class="fas fa-caret-down fa-lg"></i>
            </button>
            <span class="colored numDownvotes"><?= $comment['downvotes']?></span>
        <?php 
          }else
          {?>
            <button type="submit" class="votedown_btn commentVoteDown"  user=<?=$_SESSION['username']?> action=0 story=<?=$comment['story_id']?> comment=<?=$comment['id']?>>
              <i class="fas fa-caret-down fa-lg"></i>
            </button>
            <span class="numDownvotes"><?= $comment['downvotes']?></span> 
      <?php } ?>
      </section>
      <span id ="divDot">&bull;</span>
      <span id="date"> <?= date('d/m/Y', $date)?></span>
    </footer>  
  </article>
<?php 
} ?>

<?php function draw_add_comment($story) {
/**
 * Draws a new comment form
 */ 
?>
  <section id="add_comment">
  <?php $igmsrc = getUserImage($_SESSION['username']);?>
      <img  id="userImage"  src=<?=$igmsrc?> width=35 height="35" class="roundImage">
    <form id="insert_comment" method="POST" action="../pages/mainpage.php">
      <input type="text" name="story" value=<?=$story?> hidden>
      <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
      <textarea  class="inputField" rows="1" cols="112" name="comment" placeholder="Add a comment" required></textarea>
      <input type="submit" hidden>
      <button type="button" class="add_comment_btn">
        <i class="fas fa-angle-down fa-2x"></i>
      </button>
    </form>
  </section>
<?php 
} ?>