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
  <script type="text/javascript" src="../scripts/profile_activity.js"></script>
  <article id="story" class = "blockStyle ">
    <header> 
    <?php $igmsrc = getUserImage($story['author']);?>
      <img  id="userImage"  src=<?=$igmsrc?> width=20 height="20">
    <a href="../pages/profile.php?user=<?= $story['author'] ?>"><?= $story['author']?></a>
      <span id="date"> <?= date('d M Y',$date)?></span>
    </header>
    <hr class = "invisibleLine">
    <section id="body" class = "blockLayout">
      <h2><a href="../pages/story_page.php?story_id=<?=$story['id']?>"><?= $story['title']?></a></h2>
      <div id = "storyContent">
      <?php $igmsrc = getTrackImage( $story['id']);?>
      <img  id="trackImage"  src=<?=$igmsrc?> width="200" height="200">
        <div id = "storyTextAndTrack">
          <p> <?= $story['text']?></p>
          <audio src= "../tracks/<?=$story['id']?>.mp3" preload="auto"></audio>
        </div>
      </div>
    </div>
    </section>
    <hr class = "footerSeparator">
    <footer>
    <span id="channel"><a href="../pages/channel_page.php?channel=<?= $story['channel'] ?>">#<?= $story['channel']?></a></span>
    <a href="../pages/story_page.php?story_id=<?=$story['id']?>"><i class="fas fa-comment"></i></a>
      <section id="upvote" data-storyid=<?=$story['id']?>>
        <?php if (isset($_SESSION['username'])) { 
          if($uservote != null && $uservote['type'] == 1){?>
        <button type="submit" class="voteup_btn colored" id="voteupBtn" user=<?=$_SESSION['username']?> action=1 story=<?=$story['id']?>>
          <i class="fas fa-caret-up fa-2x"></i>
        </button>
        <?php 
          }else
          {?>
            <button type="submit" class="voteup_btn" id="voteupBtn" user=<?=$_SESSION['username']?> action=1 story=<?=$story['id']?>>
            <i class="fas fa-caret-up fa-2x"></i>
        </button>
          <?php } } else { ?>
          <form method="GET" action="../actions/action_login.php?message=">
            <button type="submit" class="voteup_btn" id="voteupBtn">
              <i class="fas fa-caret-up fa-2x"></i>
            </button>
          </form>
        <?php } if($uservote != null && $uservote['type'] == 1) {?>  
        <span id=numUpvotes class="colored"><?= $story['upvotes']?></span>
        <?php } else { ?>
        <span id=numUpvotes><?= $story['upvotes']?></span> 
        <?php } ?>
      </section>
      <section id="downvote" data-storyid=<?=$story['id']?>>
      <?php if (isset($_SESSION['username'])) { 
          if($uservote != null && $uservote['type'] == 0){?>
        <button type="submit" class="votedown_btn colored" id="votedownBtn" user=<?=$_SESSION['username']?> action=0 story=<?=$story['id']?>>
          <i class="fas fa-caret-down fa-2x"></i>
        </button>
        <?php 
          }else
          {?>
            <button type="submit" class="votedown_btn" id="votedownBtn" user=<?=$_SESSION['username']?> action=0 story=<?=$story['id']?>>
            <i class="fas fa-caret-down fa-2x"></i>
        </button>
          <?php } } else { ?>
          <form method="GET" action="../actions/action_login.php?message=">
            <button type="submit" class="votedown_btn" id="votedownBtn">
              <i class="fas fa-caret-down fa-2x"></i>
            </button>
          </form>
        <?php } if($uservote != null && $uservote['type'] == 0) {?>  
        <span id=numDownvotes class="colored"><?= $story['downvotes']?></span>
        <?php } else { ?>
        <span id=numDownvotes><?= $story['downvotes']?></span> 
        <?php } ?>
    </footer>  
  </article>
<?php 
} ?>

<?php function draw_comments($comments, $story) { ?>
  <section id="comment_list" class="page blockStyle blockLayout">
    <?php if (isset($_SESSION['username'])) {
    draw_add_comment($story);
    
    foreach($comments as $comment) {
      draw_comment($comment);
    } 
  }
 ?>
  </section>
<?php 
} ?>

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
  <article id="comment">
    <div id ="singleComment">
      <?php $igmsrc = getUserImage($comment['author']);?>
      <img  id="userImage"  src=<?=$igmsrc?> width=35 height="35">
      <div id ="userAndText" class="comment">
      <span id="user"><a href="../pages/profile.php?user=<?= $comment['author'] ?>"><?= $comment['author']?></a></span>
        <p><?= $comment['text']?></p>
      </div>
    </div>
    <footer>
      <section id="upvote" data-commentid=<?=$comment['id']?>>
      <?php
          if($uservote != null && $uservote['type'] == 1){?>
            <button type="submit" class="voteup_btn colored" id="commentVoteUp" user=<?=$_SESSION['username']?> action=1 story=<?=$comment['story_id']?> comment=<?=$comment['id']?>>
              <i class="fas fa-caret-up fa-lg"></i>
            </button>
            <span id=numUpvotes class="colored"><?= $comment['upvotes']?></span>
        <?php 
          }else
          {?>
            <button type="submit" class="voteup_btn" id="commentVoteUp" user=<?=$_SESSION['username']?> action=1 story=<?=$comment['story_id']?> comment=<?=$comment['id']?>>
              <i class="fas fa-caret-up fa-lg"></i>
            </button>
            <span id=numUpvotes><?= $comment['upvotes']?></span> 
      <?php } ?>
      </section>
      <section id="downvote" data-commentid=<?=$comment['id']?>>
      <?php
          if($uservote != null && $uservote['type'] == 0){?>
            <button type="submit" class="votedown_btn colored" id="commentVoteDown" user=<?=$_SESSION['username']?> action=0 story=<?=$comment['story_id']?> comment=<?=$comment['id']?>>
              <i class="fas fa-caret-down fa-lg"></i>
            </button>
            <span id=numDownvotes class="colored"><?= $comment['downvotes']?></span>
        <?php 
          }else
          {?>
            <button type="submit" class="votedown_btn" id="commentVoteDown" user=<?=$_SESSION['username']?> action=0 story=<?=$comment['story_id']?> comment=<?=$comment['id']?>>
              <i class="fas fa-caret-down fa-lg"></i>
            </button>
            <span id=numDownvotes><?= $comment['downvotes']?></span> 
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
      <img  id="userImage"  src=<?=$igmsrc?> width=35 height="35">
    <form>
      <input type="text" name="story" value=<?=$story?> hidden>
      <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
      <textarea  class="inputField" rows="1" cols="112" name="comment" placeholder="Add a comment" required></textarea>
      <button type="button" class="add_comment_btn">
        <i class="fas fa-angle-down fa-2x"></i>
      </button>
    </form>
  </section>
<?php 
} ?>