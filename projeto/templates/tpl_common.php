<?php function draw_header() { ?>
  <!DOCTYPE html>
  <html>

    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
    </head>

    <body>

      <header>
        <img src="../img/logo.png" alt="Page Logo" width="50" height="50">
        <h1><a href="newpage.php"><i class="fas fa-plus-circle"></i> New Page</a></h1>
        <h1><a href="channels.php"><i class="fas fa-hashtag"></i> Channels</a></h1>
        <h1><a href="upload.php"><i class="fas fa-upload"></i> Upload</a></h1>
      </header>    
<?php } ?>

<?php function draw_footer() {  ?>
  </body>
</html>
<?php } ?>