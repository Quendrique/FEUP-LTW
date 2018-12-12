<?php function draw_header($username) { ?>
  <!DOCTYPE html>
  <html>

    <head>
      <meta charset="utf-8">
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
    </head>

    <body>
      <div class = "navBar">
        <nav class="tabs">
          <ul>
            <li><a href="../pages/mainpage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="../pages/channels_list.php"><i class="fas fa-hashtag"></i> Channels</a></li>
            <?php if ($username != NULL) { ?>
              <li><a href="../pages/add_channel.php?username=<?= $username ?>"><i class="fas fa-plus-circle"></i> Add Channel</a></li>
              <li><a href="../pages/upload.php?username=<?= $username ?>"><i class="fas fa-file-upload"></i> New Story</a></li>
            <?php } ?> 
          </ul>
          <form method="GET" action="../pages/search.php">
            <input type="text" name="search" class="inputField" placeholder="Search..." required>
          </form>
          <a href="../pages/mainpage.php"><img id="logo" src= "../img/logo.png" height="40" width="40"/></a>
          <a href="../pages/mainpage.php"><img id="name" src= "../img/name.png" height="50" width="60"/></a>
        </nav>
      </div>
<?php } 
?>

<?php function draw_footer() {  ?>
  </body>
</html>
<?php } ?>