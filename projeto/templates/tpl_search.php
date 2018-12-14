<?php function draw_search_results($search_stories, $search_channels, $search_comments) {
/**
 * Draws search results
 */ ?>

  <section id="search_results" class="page ">
  <script type="text/javascript" src="../scripts/activity.js"></script>
    <header>
      <h1>Search Results</h1>
      <div id="links">
        <input type="button" value="All" id="All"  onclick="loadSearchResults(event)" />
        <input type="button" value="Posts" id="Posts" onclick="loadSearchResults(event)" />
        <input type="button" value="Comments" id="Comments"  onclick="loadSearchResults(event)" />
        <input type="button" value="Channels" id="Channels"  onclick="loadSearchResults(event)" />
      </div>
    </header>
        <div id="activityStories" class="activityDiv">
          <hr> <span ><h1 class="activityTitle">Posts</h1></span> <hr> 
        </div> 
        <?php draw_search_stories($search_stories); ?>
        <div id="activityComments" class="activityDiv">
          <hr> <span ><h1 class="activityTitle">Channels</h1></span> <hr> 
        </div> 
        <?php draw_search_channels($search_channels); ?>
        <div id="activityChannels" class="activityDiv">
          <hr> <span ><h1 class="activityTitle">Comments</h1></span> <hr> 
        </div> 
        <?php draw_search_comments($search_comments);?>
  </section>
<?php } ?>

<?php function draw_search_stories($search_stories) {
/**
 * Draws story search results
 */ ?>

  <section id="search_stories" class="searchCard" style="display: inline;">
  <?php  foreach($search_stories as $search_story) {
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

<?php function draw_search_channels($search_channels) {
/**
 * Draws channel search results
 */ ?>
  
  <section id="search_channels" class="searchCard blockStyle" style="display: inline;">
    <ul>
    <?php 
      foreach($search_channels as $search_channel) { ?>
        <li><a href="../pages/channel_page.php?channel=<?= $search_channel['name']?>"><?= $search_channel['name']?></a></li>
    <?php }
    ?>
    </ul>
  </section>
<?php } ?>

<?php function draw_search_comments($search_comments) {
/**
 * Draws channel search results
 */ 
  include_once('../templates/tpl_stories.php');
?>

    <section id="search_comments" class="searchCard blockStyle" style="display: inline;">
    <ul>
    <?php 
      foreach($search_comments as $search_comment) {
        draw_comment($search_comment);
      }
    ?>
    </ul>
    </section>
<?php } ?>
