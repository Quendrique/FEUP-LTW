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

<?php function draw_story($story) {
/**
 * Draws a single story
 * page.
 */ ?>
  <article id="story">
    <header> 
    <h2><?= $story['id']?></h2>
    </header>
    <h3>Test</h3>
  </article>
<?php } ?>
