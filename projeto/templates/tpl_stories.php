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
    <h2><?= $story['title']?></h2>
    <img src= 'data:image/jpeg;base64,'.base64_encode($coverImage)/> 
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

<?php function draw_comments($comments) {
/**
 * Draws a single story
 * page.
 */ 
?>
  <section id="comment_list" class="page blockStyle blockLayout">
    <?php foreach($comments as $comment) {
      draw_comment($comment);
    } ?>
  </section>
<?php 
} ?>

<?php function draw_comment($comment) {
/**
 * Draws a single story
 * page.
 */ 
?>
  <article id="comment">
    <h2><?= $comment['id']?></h2>
  </section>
<?php 
} ?>