<?php function draw_channels_list($channels) {
/**
 * Draws a section (#lists) containing several lists
 * as articles. Uses the draw_list function to draw
 * each list.
 */ ?>
  <section id="channels">
  <?php 
    foreach($channels as $channel)
      draw_channel_list($channel);
  ?>
  </section>
<?php } ?>

<?php function draw_channel_list($channel) {
/**
 * Draws a 'minified' channel description for the channels' list
 * page.
 */ ?>
  <article class="channel_list_item">
    <header><a href="../pages/channel_page.php?channel=<?= $channel['id'] ?>"><?= $channel['name']?></a></header>
    <h2><?= $channel['author']?></h2>
  </article>
<?php } ?>

<?php function draw_channel_page($channel) {
/**
 * Draws a channel's page
 * page.
 */ ?>
  <section class="channel_page">
    <header><h2><?= $channel['name']?></h2></a></header>
    <h2><?= $channel['id']?></h2>
  </section>
<?php } ?>
