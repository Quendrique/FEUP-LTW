<?php function draw_channels($channels) {
/**
 * Draws a section (#lists) containing several lists
 * as articles. Uses the draw_list function to draw
 * each list.
 */ ?>
  <section id="channels">

  <?php 
    foreach($channels as $channel)
      draw_channel_info($channel);
  ?>

  </section>
<?php } ?>

<?php function draw_channel_info($channel) {
/**
 * Draws a 'minified' channel description for the channels
 * page.
 */ ?>
  <article class="channel_info">
    <header><h2><?=$channel['name']?></h2></header>
  </article>
<?php } ?>



