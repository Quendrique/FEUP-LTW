<?php function draw_header() { ?>
  <!DOCTYPE html>
  <html>

    <head>
      <meta charset="utf-8">
      <title>Site Name</title>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
    </head>

    <body>
      <div class = "navBar">
        <img src= "../img/logo.png" height="40" width="40"/>
          <nav class="tabs">
            <ul>
              <li><a href="profile.php"><i class="fas fa-bars"></i></a></li>
              <li><a href="upload.php"><i class="fas fa-upload"></i> Upload</a></li>
              <li><a href="channels.php"><i class="fas fa-hashtag"></i> Channels</a></li>
              <li><a href="newpage.php"><i class="fas fa-plus-circle"></i> New Page</a></li>
            </ul>
          </nav>
      </div> 
 
<?php } ?>

<?php function draw_footer() {  ?>
  </body>
</html>
<?php } ?>