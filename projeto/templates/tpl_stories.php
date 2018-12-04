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
  <section id="story_page">
    <?php 
      draw_story($story); 
    ?>
    
</section>
<?php } ?>

<?php function draw_story($story) {
/**
 * Draws a single story
 * page.
 */ ?>
 <script src="../audiojs/audio.min.js"></script>
 <script>
   audiojs.events.ready(function() {
    audiojs.createAll();
  });
</script>
  <article id="story" >
    <header> 
    <span id="user"> <?= $story['author']?></span>
    <span id="date"> <?= $story['date']?></span>
    </header>
    <h2><?= $story['title']?></h2>
    <!--<img src= <?= $story['coverImage']?>/>
    <audio id="uploadedTrack" preload="auto" src= <?= $story['track']?>></audio>-->
    <p> <?= $story['text']?></p>
  </article>
<?php 
} ?>

<?php function draw_comments($comments) {
/**
 * Draws a single story
 * page.
 */ 
?>
  <section id="comment_list">
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


