<?php function draw_channels_list($channels) {
/**
 * Draws a section (#lists) containing several lists
 * as articles. Uses the draw_list function to draw
 * each list.
 */ ?>
  <section id="channel_list" class= "blockStyle page">
  <h1 class="mainCardH1 sidebarCardHeader">Channels</h1>
    <hr class = "invisibleLine">
    <section id="content" class="blockLayout">
    <header>
      <h2>Channel Name</h2>
      <h2>Author</h2>
    </header>
  <?php 
    foreach($channels as $channel)
      draw_channel_list($channel);
  ?>
  </section>
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
  <section id="channel_info" channel=<?= $channel['name']?> class="blockStyle">
    <header>
      <h1>#<?= $channel['name']?></h1>
      <h2 id="sub_count"><?= $subCount['numSubs']?> subscriber(s)</h2>
      <?php
      if (isset($_SESSION['username'])) { 
        if (!(isSubbedTo($_SESSION['username'], $channel['name']))) {?>
        <button id="submit" type="submit" user=<?=$_SESSION['username']?> action=1 channel=<?=$channel['name']?>>Subscribe</button>
      <?php } else { ?>
        <button id="submit" type="submit" user=<?=$_SESSION['username']?> action=0 channel=<?=$channel['name']?>>Unsubscribe</button>
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

  <section id="add_channel" class= "blockStyle page">

    <h1 class="mainCardH1 sidebarCardHeader">Create a new channel</h1>
    <hr class = "invisibleLine">
    <form method="post" action="../actions/action_add_channel.php" class="blockLayout">
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

  <section id="add_channel" class="page blockStyle blockLayout">

    <h1>Edit #<?=$channel['name']?></h1>
   
    <form method="post" action="../actions/action_edit_channel.php">
      <p>Description: </p>
      <input type="text" name="channel" value=<?=$channel['name']?> hidden>
      <textarea  class="inputField" rows="8" cols="50" name="description"  required><?=$channel['description']?></textarea>
      <input id="submit" type="submit" value="Update">          
    </form>

  </section>
<?php } ?>
