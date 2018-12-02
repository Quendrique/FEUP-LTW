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
    <a href="../pages/channel_page.php?channel=<?= $channel['name'] ?>"><?= $channel['name']?></a>
    <a href="../pages/profile.php?user=<?= $channel['author'] ?>"><?= $channel['author']?></a>
  </article>
<?php } ?>

<?php function draw_channel_page($channel, $stories) {
/**
 * Draws a channel's page
 * page.
 */ ?>
  <section id="channels">
    <header>
      <h1><?= $channel['name']?></h1>
      <?php
      if (isset($_SESSION['username'])) { 
        if (!(isSubbedTo($_SESSION['username'], $channel['name']))) {?>
        <form method="post" action="../actions/action_sub_channel.php">
          <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
          <input type="text" name="channel" value=<?=$channel['name']?> hidden>
          <input id="submit" type="submit" value="Subscribe">
        </form>
      <?php } else { ?>
          <form method="post" action="../actions/action_unsub_channel.php">
              <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
              <input type="text" name="channel" value=<?=$channel['name']?> hidden>
              <input id="submit" type="submit" value="Unsubscribe">
          </form>
      <?php 
        }
      } ?>
    </header>

    <?php
      draw_stories($stories);
    ?>

  </section>
<?php } ?>

<?php function draw_stories($stories) {
/**
 * Draws a channel's stories
 * page.
 */ ?>

  <section id="stories">
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
    <h2><?= $story['id']?></h2>
  </article>
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
      <input type="text" name="channel" >
      <input id="submit" type="submit" value="Create">
    </form>

  </section>
<?php } ?>
