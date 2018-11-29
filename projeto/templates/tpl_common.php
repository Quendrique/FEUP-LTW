<?php function draw_header($username) { ?>
  <!DOCTYPE html>
  <html>

    <head>
      <meta charset="utf-8">
      <title>Mel-o</title>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
    </head>

    <body>
      <div class = "navBar">
          <nav class="tabs">
            <ul>
              <li><a href="../pages/mainpage.php"><i class="fas fa-home"></i> Home</a></li>
              <li><a href="../pages/channels_list.php"><i class="fas fa-hashtag"></i> Channels</a></li>
              <?php if ($username != NULL) { ?>
                <li><a href="../pages/add_channel.php?username=<?= $username ?>"><i class="fas fa-plus-circle"></i> Add Channel</a></li>
              <?php } ?> 
            </ul>
            <form method="get" action="../pages/search.php">
              <label><input type="text" name="search" class="inputField" placeholder="Search..." required></label>
            </form>
          </nav>
          <img src= "../img/logo.png" height="40" width="40"/>
        </div> 
 
<?php } ?>

<?php function draw_footer() {  ?>
  </body>
</html>
<?php } ?>