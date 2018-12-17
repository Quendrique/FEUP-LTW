<?php function draw_channels($channels) {
?>
  <section id="channels">

  <?php 
    foreach($channels as $channel)
      draw_channel_info($channel);
  ?>

  </section>
<?php } ?>

<?php function draw_channel_info($channel) {
?>
  <article class="channel_info">
    <header><h2><?=$channel['name']?></h2></header>
  </article>
<?php } ?>



