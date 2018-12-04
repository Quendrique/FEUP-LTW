<?php function draw_channels_list($channels) {
/**
 * Draws a section (#lists) containing several lists
 * as articles. Uses the draw_list function to draw
 * each list.
 */ ?>
  <section id="channel_list" class= "blockStyle blockLayout page">
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

<?php function draw_channel_page($channel, $subCount) {
/**
 * Draws a channel's page
 * page.
 */ ?>
  <section id="channel_info">
    <header>
      <h1>#<?= $channel['name']?></h1>
      <h2><?= $subCount['numSubs']?> subscriber(s)</h2>
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
        if($_SESSION['username'] == $channel['author'])
        { ?>
             <form method="post" action="../pages/edit_channel.php">
              <input type="text" name="user" value=<?=$_SESSION['username']?> hidden>
              <input type="text" name="channel" value=<?=$channel['name']?> hidden>
              <input id="submit" type="submit" value="Edit">
          </form>
        <?php }
      } ?>
    </header>
    <p><?= $channel['description']?></p> 
  </section>
<?php } ?>

<?php function add_new_channel($username) {
/**
 * Draws a channel's page
 * page.
 */ ?>

  <section id="add_channel" class= "blockStyle blockLayout page">

    <h1>Create a new channel</h1>
   
    <form method="post" action="../actions/action_add_channel.php">
      <input type="text" name="username" value=<?=$username?> hidden>
      <p>Channel name: </p>
      <input class="inputField" type="text" name="channel" >
      <p>Description: </p>
      <textarea  class="inputField" rows="8" cols="50" name="description" placeholder="Description" required></textarea>
      <input id="submit" type="submit" value="Create">          
    </form>

  </section>
<?php } ?>

<?php function draw_edit_channel($channel) {
/**
 * Draws a channel's page
 * page.
 */ ?>

  <section id="add_channel">

    <h1>Edit channel</h1>
   
    <form method="post" action="../actions/action_edit_channel.php">
      <p>Channel name: </p>
      <input class="inputField" type="text" name="channel" value=<?=$channel['name']?> readonly>
      <p>Description: </p>
      <textarea  class="inputField" rows="8" cols="50" name="description"  required><?=$channel['description']?></textarea>
      <input id="submit" type="submit" value="Update">          
    </form>

  </section>
<?php } ?>
