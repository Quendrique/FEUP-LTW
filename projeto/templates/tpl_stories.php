<?php function draw_stories($stories) {
/**
 * Draws a channel's stories
 * page.
 */ ?>

  <section id="story_list">
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
 <script src="../audiojs/audio.min.js"></script>
 <script>
   audiojs.events.ready(function() {
    audiojs.createAll();
  });
</script>
  <article id="story" class = "blockStyle blockLayout">
    <header> 
      <span id="user"> <?= $story['author']?></span>
      <span id="date"> <?= date('d M Y',$date)?></span>
    </header>
    <h2><a href="../pages/story_page.php?story_id=<?=$story['id']?>"><?= $story['title']?></a></h2>
    <img src= "../img/thumbs_medium/<?=$story['id']?>.png" width="200" height="200">
    <p> <?= $story['text']?></p>
    <footer>
      <section id="upvote">
        <form method="post" action="../actions/action_vote_story.php">
          <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
          <input type="number" name="action" value= 1 hidden>
          <input type="text" name="story" value=<?=$story['id']?> hidden>
          <button type="submit" class="voteup_btn">
            <i class="fas fa-caret-up fa-2x"></i>
          </button>
        </form>
        <span id = numUpvotes><?= $story['upvotes']?></span>
      </section>
      <section id="downvote">
        <form method="post" action="../actions/action_vote_story.php">
          <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
          <input type="number" name="action" value= 0 hidden>
          <input type="text" name="story" value=<?=$story['id']?> hidden>
          <button type="submit" class="votedown_btn">
            <i class="fas fa-caret-down fa-2x"></i>
          </button>
        </form>
        <span id = numDownvotes><?= $story['downvotes']?></span>
      </section>
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
    <?php foreach($comments as $comment) {
      draw_comment($comment, $story);
    } 
      draw_add_comment($story);
    ?>
  </section>
<?php 
} ?>

<?php function draw_comment($comment, $story) {
/**
 * Draws a single story
 * page.
 */ 
  $date_str = $comment['datetime'];
  $date = strtotime($date_str);
?>
  <article id="comment">
    <header> 
      <span id="user"> <?= $comment['author']?></span>
      <span id="date"> <?= date('d M Y', $date)?></span>
    </header>
    <p><?= $comment['text']?></p>
    <footer>
      <section id="upvote">
        <form method="post" action="../actions/action_vote_comment.php">
          <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
          <input type="number" name="action" value=1 hidden>
          <input type="text" name="comment" value=<?=$comment['id']?> hidden>
          <input type="text" name="story" value=<?=$story?> hidden>
          <button type="submit" class="voteup_btn">
            <i class="fas fa-caret-up fa-2x"></i>
          </button>
        </form>
        <span id = numUpvotes><?= $comment['upvotes']?></span>
      </section>
      <section id="downvote">
        <form method="post" action="../actions/action_vote_comment.php">
          <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
          <input type="number" name="action" value=0 hidden>
          <input type="text" name="comment" value=<?=$comment['id']?> hidden>
          <input type="text" name="story" value=<?=$story?> hidden>
          <button type="submit" class="votedown_btn">
            <i class="fas fa-caret-down fa-2x"></i>
          </button>
        </form>
        <span id = numDownvotes><?= $comment['downvotes']?></span>
      </section>
    </footer>  
  </article>
<?php 
} ?>

<?php function draw_add_comment($story) {
/**
 * Draws a new comment form
 */ 
?>
  <section id="add_comment" class="page blockStyle blockLayout">
    <form method="post" action="../actions/action_add_comment.php">
      <input type="text" name="story" value=<?=$story?> hidden>
      <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
      <input type="text" name="comment" placeholder="Add a comment">
      <button type="submit" class="add_comment_btn">Post</button>
    </form>
  </section>
<?php 
} ?>