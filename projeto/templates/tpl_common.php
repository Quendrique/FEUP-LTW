<?php function draw_header($username) { ?>
  <!DOCTYPE html>
  <html>

    <head>
      <meta charset="utf-8">
      <meta name="theme-color" content="#aec5e0ba" />
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Mel-o</title>
      
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
      <link rel="icon" href="../img/logo.png"/>
      <script src="../scripts/vote_story.js" defer></script>
      <script src="../scripts/vote_comment.js" defer></script>
      <script src="../scripts/sub.js" defer></script>
      <script src="../scripts/comment.js" defer></script>
      <script src="../scripts/sorting.js" defer></script>
      <script src="../scripts/responsive.js" defer></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
    </head>
<?php } 
?>



<?php function draw_navBar($username) { ?>

  <body class="regularBody">
  <div class = "navBar">
    <nav id="tabs" class="tabs">
      <?php $igmsrc = getUserImage($username);?>
      <img  src=<?=$igmsrc?> width=40 height="40" class="roundImage" onclick="showDropDown(event)"> 
      <ul class="hamburgerMenu" > 
        <button class="navIcon" onclick="showHamburher(event)">
          <span></span>
        </button>
        <span id="desktopTabs" class="desktopTabs responsive">
        <li><a href="../pages/mainpage.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="../pages/channels_list.php"><i class="fas fa-hashtag"></i> Channels</a></li>
        <?php if ($username != NULL) { ?>
          <li><a href="../pages/add_channel.php?username=<?= $username ?>"><i class="fas fa-plus-circle"></i> Add Channel</a></li>
          <li><a href="../pages/upload.php?username=<?= $username ?>"><i class="fas fa-file-upload"></i> New Story</a></li>
          </span>
        <?php } ?>
      </ul>
      <form method="GET" action="../pages/search.php" class="desktopTabs">
        <input type="text" name="search" class="inputField" placeholder="Search..." required>
      </form>
      <div id="logos">
      <a href="../pages/mainpage.php"><img id="logo" src= "../img/logo.png" height="40" width="40"/></a>
      <a href="../pages/mainpage.php"><img id="name" src= "../img/name.png" height="50" width="60"/></a>
      </div>
    </nav>
    <ul id="dropDown" class="dropDown">
    <?php draw_dropDown(); ?>
      </ul>
  </div>
  
<?php } 
?>

<?php function draw_footer() {  ?>
  </body>
</html>
<?php } ?>


<?php 
  include_once('../database/db_channels.php');
function draw_dropDown() { 
  if (isset($_SESSION['username']))
  { 
    $username = $_SESSION['username'];?>
    <li><a href="../pages/profile.php?user=<?= $username ?>"> My Profile</a></li>
    <li  onclick="showSubbedChannels(event)"> My Channels</li>
    <div id="subbedChannels">
      <?php $channels =getSubbedChannels($username); 
        foreach($channels as $channel){ ?>  
          <a class="subbedChannel" href="../pages/channel_page.php?channel=<?= $channel['channel'] ?>"> <?= $channel['channel'] ?></a>
      <?php } ?>  
      </div>    
    <li><a href="../actions/action_logout.php"> Logout</a></li>
  <?php } else {?>  
    <li><a href="../pages/login.php"> Log In</a></li>
<?php } }?>  