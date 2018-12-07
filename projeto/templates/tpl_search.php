<?php function draw_search_results($search_stories, $search_channels) {
/**
 * Draws search results
 */ ?>

  <section id="search_results" class="page blockStyle blockLayout">
    <?php 
      draw_search_stories($search_stories);
      //draw_search_channels($search_channels);
    ?>
  </section>
<?php } ?>

<?php function draw_search_stories($search_stories) {
/**
 * Draws story search results
 */ ?>

  <section id="search_stories">
    <?php 
      foreach($search_stories as $search_story) {
        draw_search_story($search_story);
      }
    ?>
  </section>
<?php } ?>

<?php function draw_search_story($search_story) {
/**
 * Draws a single result from the story search
 */ 
  include_once('../templates/tpl_stories.php');
  
  draw_story($search_story);
} ?>

