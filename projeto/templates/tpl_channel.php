<?php function draw_channels_list($channels) {
/**
 * Draws a section (#lists) containing several lists
 * as articles. Uses the draw_list function to draw
 * each list.
 */ ?>
  <section id="channels">
    <h1>Channels</h1>
    <header>
      <h2>Channel Name</h2>
      <h2>Author</h2>
    </header>
    </article>
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
    <a href="../pages/channel_page.php?channel_name=<?= $channel['name'] ?>"><?= $channel['name']?></a>
    <a href="../pages/profile.php?user=<?= $channel['author'] ?>"><?= $channel['author']?></a>
  </article>
<?php } ?>

<?php function draw_channel_page($channel) {
/**
 * Draws a channel's page
 * page.
 */ ?>
  <section id="channels">
    <header><h2><?= $channel['name']?></h2></a></header>
    <h2><?= $channel['id']?></h2>
  </section>
<?php } ?>

<?php function add_new_channel($username) {
/**
 * Draws a channel's page
 * page.
 */ ?>

  <section id="channels">

    <h1>Create a new channel</h1>

    <form method="post" action="../actions/action_add_channel.php">
      <input type="text" name="username" value=<?=$username?> hidden>
      <p>Channel name: </p>
      <input type="text" name="channel_name" >
      <input id="submit" type="submit" value="Create">
    </form>

  </section>
<?php } ?>
