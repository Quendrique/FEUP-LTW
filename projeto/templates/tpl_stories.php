<?php function draw_stories($stories) {
/**
 * Draws a channel's stories
 * page.
 */ ?>

  <section id="story_list">
  <script src="../audiojs/audio.min.js"></script>
  <script>audiojs.events.ready(function() {
            audiojs.createAll();
    });</script>
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
?>
  <article id="story" class = "blockStyle ">
    <header> 
      <span id="user"> <?= $story['author']?></span>
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
    <span id="channel">#<?= $story['channel']?></span>
    <a href="../pages/story_page.php?story_id=<?=$story['id']?>"><i class="fas fa-comment"></i></a>
      <section id="upvote" data-storyid=<?=$story['id']?>>
        <button type="submit" class="voteup_btn" user=<?=$_SESSION['username']?> action=1 story=<?=$story['id']?>>
          <i class="fas fa-caret-up fa-2x"></i>
        </button>
        <span id=numUpvotes><?= $story['upvotes']?></span>
      </section>
      <section id="downvote" data-storyid=<?=$story['id']?>>
        <button type="submit" class="votedown_btn" user=<?=$_SESSION['username']?> action=0 story=<?=$story['id']?>>
          <i class="fas fa-caret-down fa-2x"></i>
        </button>
        <span id=numDownvotes><?= $story['downvotes']?></span>
    </footer>  
  </article>
<?php 
} ?>

<?php function draw_comments($comments, $story) {
/**
 * Draws a single story
 * page.
 */ 
?>
  <section id="comment_list" class="page blockStyle blockLayout">
    <?php draw_add_comment($story);
    
    foreach($comments as $comment) {
      draw_comment($comment, $story);
    } 
    ?>
  </section>
<?php 
} ?>

<?php include_once('../templates/tpl_account.php');

function draw_comment($comment, $story) {
/**
 * Draws a single story
 * page.
 */ 
  $date_str = $comment['datetime'];
  $date = strtotime($date_str);
?>
  <article id="comment">
    <div id ="singleComment">
      <?php $igmsrc = getUserImage($comment['author']);?>
      <img  id="userImage"  src=<?=$igmsrc?> width=35 height="35">
      <div id ="userAndText" class="comment">
        <span id="user"> <?= $comment['author']?></span>
        <p><?= $comment['text']?></p>
      </div>
    </div>
    <footer>
      <section id="upvote" data-commentid=<?=$comment['id']?>>
        <button type="submit" class="voteup_btn" user=<?=$_SESSION['username']?> action=1 story=<?=$story?> comment=<?=$comment['id']?>>
          <i class="fas fa-caret-up fa-lg"></i>
        </button>
        <span id = numUpvotes><?= $comment['upvotes']?></span>
      </section>
      <section id="downvote" data-commentid=<?=$comment['id']?>>
        <button type="submit" class="votedown_btn" user=<?=$_SESSION['username']?> action=0 story=<?=$story?> comment=<?=$comment['id']?>>
          <i class="fas fa-caret-up fa-lg"></i>
        </button>
        <span id = numDownvotes><?= $comment['downvotes']?></span>
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
    <form method="post" action="../actions/action_add_comment.php">
      <input type="text" name="story" value=<?=$story?> hidden>
      <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
      <textarea  class="inputField" rows="1" cols="112" name="comment" placeholder="Add a comment" required></textarea>
      <button type="submit" class="add_comment_btn">
      <i class="fas fa-angle-down fa-2x"></i>
       </button>
    </form>
  </section>
<?php 
} ?>